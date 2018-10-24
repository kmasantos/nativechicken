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

    // public function getBrooderGrower ()
    // {
    //     $broodergrowers = BrooderGrower::join('families', 'families.id', 'brooder_growers.family_id')
    //             ->join('lines', 'lines.id', 'families.line_id')
    //             ->join('generations', 'generations.id', 'lines.generation_id')
    //             ->join('brooder_grower_inventories', 'brooder_grower_inventories.broodergrower_id', 'brooder_growers.id')
    //             ->select('brooder_growers.*', 'brooder_grower_inventories.*', 'families.number as family_number',
    //             'lines.number as line_number', 'generations.number as generation_number')
    //             ->paginate(8);
    //     return $broodergrowers;
    // }

    public function getBrooderGrowerPens ()
    {
        $broodergrowers = Pen::where('farm_id', Auth::user()->farm_id)->where('is_active', true)->where('type', 'brooder')->paginate(12);
        return $broodergrowers;
    }

    public function addBrooderGrower(Request $request)
    {
        $date = Carbon::now();
        $request->validate([
            'family_id' => 'required',
            'date_added' => 'required',
            'batching_date' => 'required',
            'total' => 'required',
            'pen_id' => 'required',
            'external' => 'required',
        ]);
        $pen = Pen::where('id', $request->pen_id)->first();

        if($pen->total_capacity < ($pen->current_capacity + $request->total)){
            return response()->json(['status' => 'error', 'message' => 'Exceeds max pen capacity']);
        }

        $broodergrowerrecord = BrooderGrower::where('family_id', $request->family_id)->first();
        if($broodergrowerrecord == null){
            $newbroodergrower = new BrooderGrower;
            $newbroodergrower->family_id = $request->family_id;
            $newbroodergrower->date_added = $request->date_added;
            $newbroodergrower->save();
            if($request->external){
                $newinventory = new BrooderGrowerInventory;
                $newinventory->broodergrower_id = $newbroodergrower->id;
                $newinventory->pen_id = $pen->id;
                $newinventory->batching_date = $request->batching_date;
                $newinventory->total = $request->total;
                $newinventory->last_update = $date->toDateString();
                $newinventory->save();

                $pen->current_capacity = $pen->current_capacity + $request->total;
                $pen->save();

                $newmovement = new AnimalMovement;
                $newmovement->date = $request->date_added;
                $newmovement->family_id = $request->family_id;
                $newmovement->pen_id = $pen->id;
                $newmovement->type = "broodersgrowers";
                $newmovement->activity = "add broodergrower external";
                $newmovement->price = null;
                $newmovement->number_male = null;
                $newmovement->number_female = null;
                $newmovement->number_total = $request->total;
                $newmovement->remarks = null;
                $newmovement->save();
                return response()->json(['status' => 'success', 'message' => 'Brooder & Grower added']);
            }else{
                $breeder = Breeder::where('family_id', $request->family_id)->first();
                if($breeder==null){
                    return response()->json(['status' => 'error', 'message' => 'Breeder not found']);
                }
                $hatchery = HatcheryRecord::where('breeder_id', $breeder->id)->where('batching_date', $request->batching_date)->first();
                if($hatchery == null || $hatchery->number_hatched < $request->total){
                    return response()->json(['status' => 'error', 'message' => 'Invalid hatchery record']);
                }

                $hatcherymovement = new AnimalMovement;
                $hatcherymovement->date = $request->date_added;
                $hatcherymovement->family_id = $request->family_id;
                $hatcherymovement->pen_id = $pen->id;
                $hatcherymovement->type = "egg";
                $hatcherymovement->activity = "move hatched eggs to brooder pen";
                $hatcherymovement->price = null;
                $hatcherymovement->number_male = null;
                $hatcherymovement->number_female = null;
                $hatcherymovement->number_total = $request->total;
                $hatcherymovement->remarks = null;
                $hatcherymovement->save();

                $newinventory = new BrooderGrowerInventory;
                $newinventory->broodergrower_id = $newbroodergrower->id;
                $newinventory->pen_id = $pen->id;
                $newinventory->batching_date = $request->batching_date;
                $newinventory->total = $request->total;
                $newinventory->last_update = $date->toDateString();
                $newinventory->save();

                $pen->current_capacity = $pen->current_capacity + $request->total;
                $pen->save();

                $newmovement = new AnimalMovement;
                $newmovement->date = $request->date_added;
                $newmovement->family_id = $request->family_id;
                $newmovement->pen_id = $pen->id;
                $newmovement->type = "broodersgrowers";
                $newmovement->activity = "add broodergrower internal";
                $newmovement->price = null;
                $newmovement->number_male = null;
                $newmovement->number_female = null;
                $newmovement->number_total = $request->total;
                $newmovement->remarks = null;
                $newmovement->save();
                return response()->json(['status' => 'success', 'message' => 'Brooder & Grower added']);
            }
        }else{
            $inventory = BrooderGrowerInventory::where('broodergrower_id', $broodergrowerrecord->id)->where('pen_id', $request->pen_id)->first();
            if($request->external){
                if($inventory==null){
                    // create a new inventory
                    $newinventory = new BrooderGrowerInventory;
                    $newinventory->broodergrower_id = $broodergrowerrecord->id;
                    $newinventory->pen_id = $request->pen_id;
                    $newinventory->batching_date = $request->batching_date;
                    $newinventory->total = $request->total;
                    $newinventory->last_update = $date->toDateString();
                    $newinventory->save();

                    $pen->current_capacity = $pen->current_capacity + $request->total;
                    $pen->save();

                    $newmovement = new AnimalMovement;
                    $newmovement->date = $request->date_added;
                    $newmovement->family_id = $request->family_id;
                    $newmovement->pen_id = $pen->id;
                    $newmovement->type = "broodersgrowers";
                    $newmovement->activity = "add broodergrower external";
                    $newmovement->price = null;
                    $newmovement->number_male = null;
                    $newmovement->number_female = null;
                    $newmovement->number_total = $request->total;
                    $newmovement->remarks = null;
                    $newmovement->save();
                    return response()->json(['status' => 'success', 'message' => 'Brooder & Grower added']);
                }else{
                    // update inventory
                    if($pen->total_capacity < ($inventory->total + $request->total)){
                        return response()->json(['status' => 'error', 'message' => 'Exceeds max pen capacity']);
                    }
                    $inventory->total = $inventory->total + $request->total;
                    $inventory->last_update = $date->toDateString();
                    $inventory->save();

                    $pen->current_capacity = $pen->current_capacity + $request->total;
                    $pen->save();

                    $newmovement = new AnimalMovement;
                    $newmovement->date = $request->date_added;
                    $newmovement->family_id = $request->family_id;
                    $newmovement->pen_id = $pen->id;
                    $newmovement->type = "broodersgrowers";
                    $newmovement->activity = "add broodergrower external";
                    $newmovement->price = null;
                    $newmovement->number_male = null;
                    $newmovement->number_female = null;
                    $newmovement->number_total = $request->total;
                    $newmovement->remarks = null;
                    $newmovement->save();
                    return response()->json(['status' => 'success', 'message' => 'Brooder & Grower added']);
                }
            }else{
                $breeder = Breeder::where('family_id', $request->family_id)->first();
                if($breeder==null){
                    return response()->json(['status' => 'error', 'message' => 'Breeder not found']);
                }
                $hatchery = HatcheryRecord::where('breeder_id', $breeder->id)->where('batching_date', $request->batching_date)->first();
                if($hatchery == null || $hatchery->number_hatched < $request->total){
                    return response()->json(['status' => 'error', 'message' => 'Invalid hatchery record']);
                }

                $hatcherymovement = new AnimalMovement;
                $hatcherymovement->date = $request->date_added;
                $hatcherymovement->family_id = $request->family_id;
                $hatcherymovement->pen_id = $pen->id;
                $hatcherymovement->type = "egg";
                $hatcherymovement->activity = "move hatched eggs to brooder pen";
                $hatcherymovement->price = null;
                $hatcherymovement->number_male = null;
                $hatcherymovement->number_female = null;
                $hatcherymovement->number_total = $request->total;
                $hatcherymovement->remarks = null;
                $hatcherymovement->save();

                if($inventory==null){
                    $newinventory = new BrooderGrowerInventory;
                    $newinventory->broodergrower_id = $broodergrowerrecord->id;
                    $newinventory->pen_id = $pen->id;
                    $newinventory->batching_date = $request->batching_date;
                    $newinventory->total = $request->total;
                    $newinventory->last_update = $date->toDateString();
                    $newinventory->save();

                    $pen->current_capacity = $pen->current_capacity + $request->total;
                    $pen->save();

                    $newmovement = new AnimalMovement;
                    $newmovement->date = $request->date_added;
                    $newmovement->family_id = $request->family_id;
                    $newmovement->pen_id = $pen->id;
                    $newmovement->type = "broodersgrowers";
                    $newmovement->activity = "add broodergrower internal";
                    $newmovement->price = null;
                    $newmovement->number_male = null;
                    $newmovement->number_female = null;
                    $newmovement->number_total = $request->total;
                    $newmovement->remarks = null;
                    $newmovement->save();
                    return response()->json(['status' => 'success', 'message' => 'Brooder & Grower added']);
                }else{
                    if($pen->total_capacity < ($inventory->total + $request->total)){
                        return response()->json(['status' => 'error', 'message' => 'Exceeds max pen capacity']);
                    }
                    $inventory->total = $inventory->total + $request->total;
                    $inventory->last_update = $date->toDateString();
                    $inventory->save();

                    $pen->current_capacity = $pen->current_capacity + $request->total;
                    $pen->save();

                    $newmovement = new AnimalMovement;
                    $newmovement->date = $request->date_added;
                    $newmovement->family_id = $request->family_id;
                    $newmovement->pen_id = $pen->id;
                    $newmovement->type = "broodersgrowers";
                    $newmovement->activity = "add broodergrower internal";
                    $newmovement->price = null;
                    $newmovement->number_male = null;
                    $newmovement->number_female = null;
                    $newmovement->number_total = $request->total;
                    $newmovement->remarks = null;
                    $newmovement->save();
                    return response()->json(['status' => 'success', 'message' => 'Brooder & Grower added']);
                }
            }
        }

    }

    public function fetchPenInfo ($pen_id)
    {
        $broodergrowers = BrooderGrowerInventory::where('pen_id', $pen_id)
        ->join('brooder_growers', 'brooder_grower_inventories.broodergrower_id', 'brooder_growers.id')
        ->join('families', 'brooder_growers.family_id', 'families.id')
        ->join('lines', 'families.line_id', 'lines.id')
        ->select('brooder_grower_inventories.*', 'brooder_growers.*', 'families.number as fam_number', 'lines.number as line_number',
        'families.id as fam_id', 'brooder_growers.id as bg_id', 'brooder_grower_inventories.id as inv_id')
        ->get();

        return $broodergrowers;
    }

    public function updateBrooderGrower(Request $request)
    {
        $date = Carbon::now();
        $request->validate([
            'broodergrower_id' => 'required',
            'male' => 'required',
            'female' => 'required',
        ]);
        $broodergrower = BrooderGrowerInventory::where('broodergrower_id', $request->broodergrower_id)->firstOrFail();
        if($broodergrower->total != ($request->male + $request->female)){
            return response()->json(['status' => 'error', 'message' => 'Brooder & Grower update failed']);
        }else{
            $broodergrower->number_male = $request->male;
            $broodergrower->number_female = $request->female;
            $broodergrower->last_update = $date->toDateString();
            $broodergrower->save();
            return response()->json(['status' => 'success', 'message' => 'Brooder & Grower updated']);
        }
    }

    public function getFeedingRecord()
    {
        return view('chicken.broodergrower.feedingrecord');
    }

    public function fetchFeedingRecords($broodergrower_id)
    {
        $feedingrecords = BrooderGrowerFeeding::where('broodergrower_id', $broodergrower_id)->orderBy('date_collected', 'desc')->paginate(10);
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
            $feeding->broodergrower_id = $inventory->broodergrower_id;
            $feeding->pen_id = $inventory->pen_id;
            $feeding->date_collected = $request->date_collected;
            $feeding->amount_offered = round($inventory->total*$feed_offered_per_head, 3);
            $feeding->amount_refused = round($inventory->total*$feed_refused_per_head, 3);
            $feeding->remarks = $request->remarks;
            $feeding->save();
        }
        return response()->json(['status' => 'success', 'message' => 'Feeding Records added']);
    }

    // public function getGrowthRecord()
    // {
    //     return view('chicken.broodergrower.growthrecord');
    // }

    // public function fetchGrowthRecords($broodergrower_id)
    // {
    //     $growthrecords = BrooderGrowerGrowth::where('broodergrower_id', $broodergrower_id)->orderBy('date_collected', 'desc')->paginate(10);
    //     return $growthrecords;
    // }

    public function addGrowthRecord(Request $request)
    {
        if($request->sexing){
            $request->validate([
                'pen_id' => 'required',
                'collection_day' => 'required',
                'date_collected' => 'required',
                'male_weight' => 'required',
                'female_weight' => 'required',
            ]);
            $pen = Pen::where('id', $request->pen_id)->first();
            $inventories = BrooderGrowerInventory::where('pen_id', $request->pen_id)->get();
            $weight_per_male = $request->male_weight/$inventories->number_male;
            $weight_per_female = $request->female_weight/$inventories->number_female;
            foreach ($inventories as $inventory) {
                $growth = new BrooderGrowerGrowth;
                $growth->broodergrower_id = $inventory->broodergrower_id;
                $growth->pen_id = $inventory->pen_id;
                $growth->collection_day = $request->collection_day;
                $growth->date_collected = $request->date_collected;
                $growth->male_quantity = $inventory->number_male;
                $growth->male_weight = $inventory->number_male*$weight_per_male;
                $growth->female_quantity = $inventory->number_female;
                $growth->female_weight = $inventory->number_female*$weight_per_female;
                $growth->total_quantity = $inventory->number_male + $inventory->number_female;
                $growth->total_weight = $growth->male_weight + $growth->female_weight;
                $growth->save();
            }
        }else{
            $request->validate([
                'pen_id' => 'required',
                'collection_day' => 'required',
                'date_collected' => 'required',
                'total_weight' => 'required',
            ]);
            $pen = Pen::where('id', $request->pen_id)->first();
            $weight_per_head = $request->total_weight/$pen->current_capacity;
            $inventories = BrooderGrowerInventory::where('pen_id', $request->pen_id)->get();
            foreach ($inventories as $inventory) {
                $growth = new BrooderGrowerGrowth;
                $growth->broodergrower_id = $inventory->broodergrower_id;
                $growth->pen_id = $inventory->pen_id;
                $growth->collection_day = $request->collection_day;
                $growth->date_collected = $request->date_collected;
                $growth->total_quantity = $pen->current_capacity;
                $growth->total_weight = round($inventory->total_quantity*$weight_per_head, 3);
                $growth->save();
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Growth Records added']);
    }

    /**
     * TODO Refacctor for better queries
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
