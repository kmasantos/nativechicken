<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;
use App\Models\Generation;
use App\Models\Line;
use App\Models\Family;
use App\Models\Pen;
use App\Models\BrooderGrower;
use App\Models\BrooderGrowerInventory;
use App\Models\BrooderGrowerFeeding;
use App\Models\BrooderGrowerGrowth;
use App\Models\AnimalMovement;
use App\Models\HatcheryRecord;
use App\Models\Breeder;
use App\Models\MortalitySale;

class BrooderGrowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAddBrooderGrower()
    {
        return view('chicken.broodergrower.add_broodergrower');
    }

    public function getBrooderGrowerPens ()
    {
        $broodergrowers = Pen::where('farm_id', Auth::user()->farm_id)->where('is_active', true)->where('type', 'brooder')->paginate(12);
        return $broodergrowers;
    }

    public function addBrooderGrower(Request $request)
    {
        $code = Auth::user()->getFarm()->code;
        $timestamp = Carbon::now()->timestamp;
        $random = random_bytes(1);
        $tag = $code.bin2hex($random).$timestamp;
        $request->validate([
            'family_id' => 'required',
            'pen_id' => 'required',
            'date_added' => 'required',
            'total' => 'required',
        ]);

        $brooder_pen = Pen::where('id', $request->pen_id)->firstOrFail();
        if($brooder_pen->total_capacity < ($brooder_pen->current_capacity + $request->total)){
            return response()->json( ['error'=>'Brooder pen does not have enough space for the chicks'] );
        }
        $brooder_record = BrooderGrower::where('family_id', $request->family_id)->first();
        if($brooder_record==null){
            $new_brooder = new BrooderGrower;
            $new_brooder->family_id = $request->family_id;
            $new_brooder->date_added = $request->date_added;
            $new_brooder->save();

            $new_brooder_inventory = new BrooderGrowerInventory;
            $new_brooder_inventory->broodergrower_id = $new_brooder->id;
            $new_brooder_inventory->pen_id = $request->pen_id;
            $new_brooder_inventory->broodergrower_tag = $tag;
            $new_brooder_inventory->batching_date = $request->batching_date;
            $new_brooder_inventory->number_male = null;
            $new_brooder_inventory->number_female = null;
            $new_brooder_inventory->total = $request->total;
            $new_brooder_inventory->last_update = $request->date_added;
            $new_brooder_inventory->save();
        }else{
            $exist = BrooderGrowerInventory::where('broodergrower_tag', 'like', $tag)->first();
            if($exist!=null){
                return response()->json(['error'=>'Duplicate Brooder & Grower tag'] );
            }
            $new_brooder_inventory = new BrooderGrowerInventory;
            $new_brooder_inventory->broodergrower_id = $brooder_record->id;
            $new_brooder_inventory->pen_id = $request->pen_id;
            $new_brooder_inventory->broodergrower_tag = $tag;
            $new_brooder_inventory->batching_date = $request->batching_date;
            $new_brooder_inventory->number_male = null;
            $new_brooder_inventory->number_female = null;
            $new_brooder_inventory->total = $request->total;
            $new_brooder_inventory->last_update = $request->date_added;
            $new_brooder_inventory->save();
        }
        $brooder_pen->current_capacity = $brooder_pen->current_capacity + $request->total;

        $brooder_movement = new AnimalMovement;
        $brooder_movement->date = $request->date_added;
        $brooder_movement->family_id = $request->family_id;
        $brooder_movement->tag = $tag;
        $brooder_movement->previous_pen_id = null;
        $brooder_movement->current_pen_id = $brooder_pen->id;
        $brooder_movement->previous_type = 'egg';
        $brooder_movement->current_type = 'broodersgrowers';
        $brooder_movement->activity = 'transfer';
        $brooder_movement->number_male = null;
        $brooder_movement->number_female = null;
        $brooder_movement->number_total = $request->total;
        $brooder_movement->remarks = 'outside system';
        $brooder_movement->save();

        $brooder_pen->save();
        return response()->json(['status' => 'success', 'message' => 'Hatchery record added']);
    }

    public function fetchPenInfo ($pen_id)
    {
        $broodergrowers = BrooderGrowerInventory::where('pen_id', $pen_id)
        ->leftJoin('brooder_growers', 'brooder_grower_inventories.broodergrower_id', 'brooder_growers.id')
        ->leftJoin('families', 'brooder_growers.family_id', 'families.id')
        ->leftJoin('lines', 'families.line_id', 'lines.id')
        ->leftJoin('generations', 'generations.id', 'lines.generation_id')
        ->select('brooder_grower_inventories.*', 'brooder_growers.*', 'families.number as fam_number', 'lines.number as line_number',
        'families.id as fam_id', 'brooder_growers.id as bg_id', 'brooder_grower_inventories.id as inv_id', 'generations.number as gen_number')
        ->orderBy('brooder_grower_inventories.last_update', 'asc')
        ->paginate(10);

        return $broodergrowers;
    }

    public function updateBrooderGrower(Request $request)
    {
        $date = Carbon::now();
        $request->validate([
            'broodergrower_inventory_id' => 'required',
            'number_male' => 'required',
            'number_female' => 'required',
        ]);
        $inventory = BrooderGrowerInventory::where('id', $request->broodergrower_inventory_id)->firstOrFail();
        $broodergrower = BrooderGrower::where('id', $inventory->broodergrower_id)->firstOrFail();
        if($inventory->total != ($request->number_male + $request->number_female)){
            return response()->json(['error' => 'Input does not match total number of animals in the pen'] );
        }else{
            $movement = new AnimalMovement;
            $movement->date = $date->toDateString();
            $movement->family_id = $broodergrower->family_id;
            $movement->tag = $inventory->broodergrower_tag;
            $movement->previous_pen_id = null;
            $movement->current_pen_id  = $inventory->pen_id;
            $movement->previous_type = 'egg';
            $movement->current_type = 'broodersgrowers';
            $movement->activity = 'update';
            $movement->number_male = $request->number_male;
            $movement->number_female = $request->number_female;
            $movement->number_total = $inventory->total;
            $movement->remarks = null;

            $inventory->number_male = $request->number_male;
            $inventory->number_female = $request->number_female;

            $movement->save();
            $inventory->save();
            return response()->json(['status' => 'success', 'message' => 'Brooder & Grower updated']);
        }
    }

    public function fetchFeedingRecords($pen_id)
    {
        $feedingrecords = BrooderGrowerFeeding::
        leftJoin('brooder_grower_inventories', 'brooder_grower_feedings.broodergrower_inventory_id', 'brooder_grower_inventories.id')
        ->select('brooder_grower_feedings.*', 'brooder_grower_inventories.*', 'brooder_grower_inventories.id as inventory_id')
        ->where('brooder_grower_inventories.pen_id', $pen_id)
        ->orderBy('brooder_grower_feedings.date_collected', 'desc')
        ->paginate(10);
        return $feedingrecords;
    }

    public function addFeedingRecord(Request $request)
    {
        $request->validate([
            'pen_id' => 'required',
            'date_collected' => 'required',
            'offered' => 'required',
            'refused' => 'required',
        ]);

        $pen = Pen::where('id', $request->pen_id)->first();
        $feed_offered_per_head = $request->offered/$pen->current_capacity;
        $feed_refused_per_head = $request->refused/$pen->current_capacity;

        $inventories = BrooderGrowerInventory::where('pen_id', $request->pen_id)->get();
        foreach ($inventories as $inventory) {
            $feeding = new BrooderGrowerFeeding;
            $feeding->broodergrower_inventory_id  = $inventory->id;
            $feeding->date_collected = $request->date_collected;
            $feeding->amount_offered = round($inventory->total*$feed_offered_per_head, 3);
            $feeding->amount_refused = round($inventory->total*$feed_refused_per_head, 3);
            $feeding->remarks = $request->remarks;
            $feeding->save();
        }
        return response()->json(['status' => 'success', 'message' => 'Feeding Records added']);
    }

    public function fetchGrowthRecords($pen_id)
    {
        $growthrecords = BrooderGrowerGrowth::
        leftJoin('brooder_grower_inventories', 'brooder_grower_growths.broodergrower_inventory_id', 'brooder_grower_inventories.id')
        ->where('brooder_grower_inventories.pen_id', $pen_id)
        ->select('brooder_grower_growths.*', 'brooder_grower_inventories.*', 'brooder_grower_inventories.id as inventory_id',
        'brooder_grower_growths.id as growth_id')
        ->orderBy('date_collected', 'desc')
        ->paginate(10);
        return $growthrecords;
    }

    public function addGrowthRecord(Request $request)
    {
        if($request->collection_day > 21){
            return response()->json(['error' => 'Collection day should not exceed 21 days']);
        }
        $invalid = false;
        $pen = Pen::where('id', $request->pen_id)->first();
        $inventories = BrooderGrowerInventory::where('pen_id', $request->pen_id)->get();
        foreach($inventories as $inventory){
            if($request->sexing==true){
                if($inventory->number_male == null || $inventory->number_female == null){
                    return response()->json(['error' => 'Some families did not undergo sexing, update male and female count']);
                }
            }
        }
        if($request->sexing){
            $request->validate([
                'date_collected' => 'required',
                'collection_day' => 'required',
                'male_weight' => 'required',
                'female_weight' => 'required'
            ]);
            $total_female = $inventories->sum('number_female');
            $weight_per_female = $request->female_weight/$total_female;
            $total_male = $inventories->sum('number_male');
            $weight_per_male = $request->male_weight/$total_male;
            foreach($inventories as $inventory){
                $check_record = BrooderGrowerGrowth::where('broodergrower_inventory_id', $inventory->id)->where('collection_day', $request->collection_day)->first();
                if($check_record == null){
                    $growth_record = new BrooderGrowerGrowth;
                    $growth_record->broodergrower_inventory_id = $inventory->id;
                    $growth_record->date_collected = $request->date_collected;
                    $growth_record->collection_day = $request->collection_day;
                    $growth_record->male_quantity = $inventory->number_male;
                    $growth_record->male_weight = round($inventory->number_male*$weight_per_male, 3);
                    $growth_record->female_quantity = $inventory->number_female;
                    $growth_record->female_weight = round($inventory->number_female*$weight_per_female, 3);
                    $growth_record->total_quantity = $inventory->total;
                    $growth_record->total_weight = $growth_record->male_weight+$growth_record->female_weight;
                    $growth_record->save();
                }
            }
            return response()->json(['status' => 'success', 'message' => 'Growth Records added']);
        }else{
            $request->validate([
                'date_collected' => 'required',
                'collection_day' => 'required',
                'total_weight' => 'required',
            ]);
            $weight_per_head = $request->total_weight/$pen->current_capacity;
            foreach($inventories as $inventory){
                $check_record = BrooderGrowerGrowth::where('broodergrower_inventory_id', $inventory->id)->where('collection_day', $request->collection_day)->first();
                if($check_record == null){
                    $growth_record = new BrooderGrowerGrowth;
                    $growth_record->broodergrower_inventory_id = $inventory->id;
                    $growth_record->date_collected = $request->date_collected;
                    $growth_record->collection_day = $request->collection_day;
                    $growth_record->total_quantity = $inventory->total;
                    $growth_record->total_weight = round($inventory->total*$weight_per_head, 3);
                    $growth_record->save();
                }
            }
            return response()->json(['status' => 'success', 'message' => 'Growth Records added']);
        }
    }

    public function selectGrowthRecords ($record)
    {
        $selected = BrooderGrowerGrowth::where('id', $record)->firstOrFail();
        $selected_inventory = BrooderGrowerInventory::where('id', $selected->broodergrower_inventory_id)->firstOrFail();
        $selected_pen = Pen::where('id', $selected_inventory->pen_id)->firstOrFail();

        $selected_records = BrooderGrowerGrowth::where('brooder_grower_growths.date_collected', $selected->date_collected)
                            ->where('brooder_grower_growths.collection_day', $selected->collection_day)
                            ->leftJoin('brooder_grower_inventories', 'brooder_grower_inventories.id', 'brooder_grower_growths.broodergrower_inventory_id')
                            ->where('brooder_grower_inventories.pen_id', $selected_inventory->pen_id)
                            ->select('brooder_grower_growths.*', 'brooder_grower_inventories.*',
                                    'brooder_grower_inventories.id as sel_inventory_id', 'brooder_grower_growths.id as sel_growth_id')
                            ->paginate(10);
        return $selected_records;
    }

    public function deleteGrowthRecord ($record)
    {
        $selected = BrooderGrowerGrowth::where('id', $record)->firstOrFail();
        $selected_inventory = BrooderGrowerInventory::where('id', $selected->broodergrower_inventory_id)->firstOrFail();
        $selected_pen = Pen::where('id', $selected_inventory->pen_id)->firstOrFail();

        $selected_records = BrooderGrowerGrowth::where('brooder_grower_growths.date_collected', $selected->date_collected)
                            ->where('brooder_grower_growths.collection_day', $selected->collection_day)
                            ->leftJoin('brooder_grower_inventories', 'brooder_grower_inventories.id', 'brooder_grower_growths.broodergrower_inventory_id')
                            ->where('brooder_grower_inventories.pen_id', $selected_inventory->pen_id)
                            ->select('brooder_grower_growths.*', 'brooder_grower_inventories.*',
                                    'brooder_grower_inventories.id as sel_inventory_id', 'brooder_grower_growths.id as sel_growth_id')
                            ->get();
        foreach ($selected_records as $record) {
            $delete = BrooderGrowerGrowth::where('id', $record->sel_growth_id)->firstOrFail();
            $delete->delete();
        }
        return response()->json(['status' => 'success', 'message' => 'Growth record deleted']);
    }

    public function getMortalitySale ($inventory_id)
    {
        $record = MortalitySale::where('brooder_inventory_id', $inventory_id)
        ->orderBy('date', 'desc')
        ->paginate(10);
        return $record;
    }

    public function addMortality (Request $request)
    {
        $brooder_inventory = BrooderGrowerInventory::where('id', $request->brooder_id)->firstOrFail();
        if($request->male > $brooder_inventory->number_male || $request->female > $brooder_inventory->number_female || $request->total > $brooder_inventory->total){
            return response()->json( ['error'=>'Input too quantity is too large for the inventory'] );
        }

        $brooder_pen = Pen::where('id', $brooder_inventory->pen_id)->firstOrFail();
        if($request->total != null){
            $brooder_inventory->total = $brooder_inventory->total - $request->total;
            $brooder_pen->current_capacity = $brooder_pen->current_capacity - $request->total;
        }else{
            $brooder_inventory->number_male = $brooder_inventory->number_male - $request->male;
            $brooder_inventory->number_female = $brooder_inventory->number_female - $request->female;
            $brooder_inventory->total = $brooder_inventory->total - ($request->male + $request->female);
            $brooder_pen->current_capacity = $brooder_pen->current_capacity - ($request->male + $request->female);
        }

        $movement = new AnimalMovement;
        $movement->date = $request->date;
        $movement->family_id = $brooder_inventory->getBrooderData()->family_id;
        $movement->tag = $brooder_inventory->tag;
        $movement->previous_pen_id = $brooder_pen->id;
        $movement->current_pen_id = null;
        $movement->previous_type = "broodersgrowers";
        $movement->current_type = "broodersgrowers";
        $movement->activity = "mortality";
        if($request->total != null){
            $movement->number_male = null;
            $movement->number_female = null;
            $movement->number_total = $request->total;
        }else{
            $movement->number_male = $request->male;
            $movement->number_female = $request->female;
            $movement->number_total = $request->male + $request->female;
        }
        $movement->remarks = $request->remarks;

        $mortality = new MortalitySale;
        $mortality->date = $request->date;
        $mortality->brooder_inventory_id = $request->brooder_id;
        $mortality->type = "brooder";
        $mortality->category = "died";
        if($request->total != null){
            $mortality->male = null;
            $mortality->female = null;
            $mortality->total = $request->total;
        }else{
            $mortality->male = $request->male;
            $mortality->female = $request->female;
            $mortality->total = $request->male + $request->female;
        }
        $mortality->reason = $request->reason;
        $mortality->remarks = $request->remarks;

        $brooder_inventory->save();
        $brooder_pen->save();
        $movement->save();
        $mortality->save();
        return response()->json(['status' => 'success', 'message' => 'Brooder mortality recorded']);
    }

    public function addSale (Request $request)
    {
        $brooder_inventory = BrooderGrowerInventory::where('id', $request->brooder_id)->firstOrFail();
        if($request->male > $brooder_inventory->number_male || $request->female > $brooder_inventory->number_female || $request->total > $brooder_inventory->total){
            return response()->json( ['error'=>'Input too quantity is too large for the inventory'] );
        }

        $brooder_pen = Pen::where('id', $brooder_inventory->pen_id)->firstOrFail();
        if($request->total != null){
            $brooder_inventory->total = $brooder_inventory->total - $request->total;
            $brooder_pen->current_capacity = $brooder_pen->current_capacity - $request->total;
        }else{
            $brooder_inventory->number_male = $brooder_inventory->number_male - $request->male;
            $brooder_inventory->number_female = $brooder_inventory->number_female - $request->female;
            $brooder_inventory->total = $brooder_inventory->total - ($request->male + $request->female);
            $brooder_pen->current_capacity = $brooder_pen->current_capacity - ($request->male + $request->female);
        }

        $movement = new AnimalMovement;
        $movement->date = $request->date;
        $movement->family_id = $brooder_inventory->getBrooderData()->family_id;
        $movement->tag = $brooder_inventory->tag;
        $movement->previous_pen_id = $brooder_pen->id;
        $movement->current_pen_id = null;
        $movement->previous_type = "broodersgrowers";
        $movement->current_type = "broodersgrowers";
        $movement->activity = "sale";
        if($request->total != null){
            $movement->number_male = null;
            $movement->number_female = null;
            $movement->number_total = $request->total;
        }else{
            $movement->number_male = $request->male;
            $movement->number_female = $request->female;
            $movement->number_total = $request->male + $request->female;
        }
        $movement->remarks = $request->remarks;

        $sales = new MortalitySale;
        $sales->date = $request->date;
        $sales->brooder_inventory_id = $request->brooder_id;
        $sales->type = "brooder";
        $sales->category = "sold";
        if($request->total != null){
            $sales->male = null;
            $sales->female = null;
            $sales->total = $request->total;
        }else{
            $sales->male = $request->male;
            $sales->female = $request->female;
            $sales->total = $request->male + $request->female;
        }
        $sales->price = $request->price;
        $sales->remarks = $request->remarks;

        $brooder_inventory->save();
        $brooder_pen->save();
        $movement->save();
        $sales->save();
        return response()->json(['status' => 'success', 'message' => 'Brooder sales recorded']);
    }

    public function cullBrooder ($inventory_id)
    {
        $now = Carbon::now();
        $inventory = BrooderGrowerInventory::where('id', $inventory_id)->firstOrFail();
        $pen = Pen::where('id', $inventory->pen_id)->firstOrFail();
        $pen->current_capacity = $pen->current_capacity - $inventory->total;

        $movement = new AnimalMovement;
        $movement->date = $now->toDateString();
        $movement->family_id = $inventory->getBrooderData()->family_id;
        $movement->tag = $inventory->broodergrower_tag;
        $movement->previous_pen_id = $pen->id;
        $movement->current_pen_id = null;
        $movement->previous_type = "broodersgrowers";
        $movement->current_type = "broodersgrowers";
        $movement->activity = "cull";
        $movement->number_male = $inventory->number_male;
        $movement->number_female = $inventory->number_female;
        $movement->number_total = $inventory->number_male + $inventory->number_female;

        $movement->save();
        $pen->save();
        $inventory->delete();
        return response()->json(['status' => 'success', 'message' => 'Culled brooders']);
    }

    /**
     * TODO Refactor for better queries
    */
    public function fetchGenerations ()
    {
        $generations = Generation::where('farm_id', Auth::user()->farm_id)->where('is_active', true)->get();
        return $generations;
    }

    public function fetchLines ($generation_id)
    {
        $lines = Line::where('is_active', true)->where('generation_id', $generation_id)->get();
        return $lines;
    }

    public function fetchFamilies ($line_id)
    {
        $families = Family::where('is_active', true)->where('line_id', $line_id)->get();
        return $families;
    }

    public function fetchPens ()
    {
        $pens = Pen::where('farm_id', Auth::user()->farm_id)->where('is_active', true)->where('type', 'brooder')->get();
        return $pens;
    }
}
