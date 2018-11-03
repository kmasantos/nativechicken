<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Generation;
use App\Models\Line;
use App\Models\Family;
use App\Models\Breeder;
use App\Models\BreederInventory;
use App\Models\Pen;
use App\Models\AnimalMovement;
use App\Models\Replacement;
use App\Models\ReplacementInventory;
use App\Models\BreederFeeding;
use App\Models\EggProduction;
use App\Models\HatcheryRecord;

class BreederController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addBreederPage()
    {
        return view('chicken.breeder.add_breeder');
    }

    public function getBreederList()
    {
        $breeders = Breeder::join('families', 'families.id', 'breeders.family_id')
                    ->join('lines', 'lines.id', 'families.line_id')
                    ->join('generations', 'generations.id', 'lines.generation_id')
                    ->select('breeders.*', 'generations.*','families.number as family_number',
                    'lines.number as line_number', 'generations.number as generation_number')
                    ->where('generations.farm_id', Auth::user()->farm_id)
                    ->paginate(8);
        return $breeders;
    }

    public function addBreeder(Request $request)
    {
        if($request->within == true){
            $request->validate([
                'breeder_tag' => 'required',
                'male_family'  => 'required',
                'male_inventory'  => 'required',
                'number_male'  => 'required|numeric',
                'female_family'  => 'required',
                'female_inventory'  => 'required',
                'number_female'  => 'required|numeric',
                'pen_id'  => 'required',
                'date_added'  => 'required|date',
            ]);
            $exists = BreederInventory::where('breeder_tag', 'like', $request->breeder_tag)->first();
            if($exists!=null){
                return response()->json( ['error'=>'Breeder tag id already exist'] );
            }
            $breeder_pen = Pen::where('id', $request->pen_id)->firstOrFail();
            if($breeder_pen->total_capacity < ($request->number_male + $request->number_female)){
                return response()->json( ['error'=>'Breeder pen capacity is too small for total male and female'] );
            }
            $breeder_pen->current_capacity = $request->number_male + $request->number_female;

            $male_inventory = ReplacementInventory::where('id', $request->male_inventory)->firstOrFail();
            $female_inventory = ReplacementInventory::where('id', $request->female_inventory)->firstOrFail();
            if(($male_inventory->number_male < $request->number_male)|| $female_inventory->number_female < $request->number_female){
                return response()->json( ['error'=>'Replacement inventory has insufficient number of animals'] );
            }

            // Update Pens
            $male_replacement_pen = Pen::where('id', $male_inventory->pen_id)->firstOrFail();
            $male_replacement_pen->current_capacity = $male_replacement_pen->current_capacity + $request->number_male;
            $female_replacement_pen = Pen::where('id', $female_inventory->pen_id)->firstOrFail();
            $female_replacement_pen->current_capacity = $female_replacement_pen->current_capacity + $request->number_female;
            // Animal Movements
            $movement_replacement_male = new AnimalMovement;
            $movement_replacement_male->date = $request->date_added;
            $movement_replacement_male->family_id = $request->male_family;
            $movement_replacement_male->previous_pen_id = $male_inventory->pen_id;
            $movement_replacement_male->current_pen_id = $request->pen_id;
            $movement_replacement_male->previous_type = 'replacement';
            $movement_replacement_male->current_type = 'breeder';
            $movement_replacement_male->activity = 'transfer';
            $movement_replacement_male->number_male = $request->number_male;
            $movement_replacement_male->number_female = 0;
            $movement_replacement_male->number_total = $request->number_male;
            $movement_replacement_male->remarks = "within";

            $movement_replacement_female = new AnimalMovement;
            $movement_replacement_female->date = $request->date_added;
            $movement_replacement_female->family_id = $request->female_family;
            $movement_replacement_female->previous_pen_id = $female_inventory->pen_id;
            $movement_replacement_female->current_pen_id = $request->pen_id;
            $movement_replacement_female->previous_type = 'replacement';
            $movement_replacement_female->current_type = 'breeder';
            $movement_replacement_female->activity = 'transfer';
            $movement_replacement_female->number_male = 0;
            $movement_replacement_female->number_female = $request->number_female;
            $movement_replacement_female->number_total = $request->number_female;
            $movement_replacement_female->remarks = "within system";

            // Update Inventories
            $male_inventory->number_male = $male_inventory->number_male - $request->number_male;
            $male_inventory->total = $male_inventory->total - $request->number_male;
            $female_inventory->number_female = $female_inventory->number_female - $request->number_female;
            $female_inventory->total = $female_inventory->total - $request->number_female;

            // Make breeder record if not in database else skip process
            $breeder_record = Breeder::where('family_id', $request->male_family)->where('female_family_id', $request->female_family)->first();
            if($breeder_record == null){
                $new_breeder = new Breeder;
                $new_breeder->family_id = $request->male_family;
                $new_breeder->female_family_id = $request->female_family;
                $new_breeder->date_added = $request->date_added;
                $new_breeder->save();

                $new_inventory = new BreederInventory;
                $new_inventory->breeder_id = $new_breeder->id;
                $new_inventory->pen_id = $request->pen_id;
                $new_inventory->breeder_tag = $request->breeder_tag;
                $new_inventory->batching_date = $male_inventory->batching_date;
                $new_inventory->number_male = $request->number_male;
                $new_inventory->number_female = $request->number_female;
                $new_inventory->total = $request->number_male + $request->number_female;
                $new_inventory->last_update = $request->date_added;
                $new_inventory->save();
            }else{
                $new_inventory = new BreederInventory;
                $new_inventory->breeder_id = $breeder_record->id;
                $new_inventory->pen_id = $request->pen_id;
                $new_inventory->breeder_tag = $request->breeder_tag;
                $new_inventory->batching_date = $male_inventory->batching_date;
                $new_inventory->number_male = $request->number_male;
                $new_inventory->number_female = $request->number_female;
                $new_inventory->total = $request->number_male + $request->number_female;
                $new_inventory->last_update = $request->date_added;
                $new_inventory->save();
            }

            $movement_replacement_male->save();
            $movement_replacement_female->save();
            $male_replacement_pen->save();
            $female_replacement_pen->save();
            $male_inventory->save();
            $female_inventory->save();
            $breeder_pen->save();

            return response()->json(['status' => 'success', 'message' => 'Breeder added']);
        }else{
            $request->validate([
                'breeder_tag' => 'required',
                'family'  => 'required',
                'number_male'  => 'required|numeric',
                'number_female'  => 'required|numeric',
                'pen_id'  => 'required',
                'date_added'  => 'required|date',
            ]);
            $exists = BreederInventory::where('breeder_tag', 'like', $request->breeder_tag)->first();
            if($exists!=null){
                return response()->json( ['error'=>'Breeder tag id already exist'] );
            }
            $breeder_pen = Pen::where('id', $request->pen_id)->firstOrFail();
            if($breeder_pen->total_capacity < ($request->number_male + $request->number_female)){
                return response()->json( ['error'=>'Breeder pen capacity is too small for total male and female'] );
            }
            $breeder_pen->current_capacity = $request->number_male + $request->number_female;

            $movement = new AnimalMovement;
            $movement->date = $request->date_added;
            $movement->family_id = $request->family;
            $movement->previous_pen_id = null;
            $movement->current_pen_id = $request->pen_id;
            $movement->previous_type = null;
            $movement->current_type = 'breeder';
            $movement->activity = 'transfer';
            $movement->number_male = $request->number_male;
            $movement->number_female = $request->number_female;
            $movement->number_total = $request->number_male + $request->number_female;
            $movement->remarks = "outside system";

            $breeder_record = Breeder::where('family_id', $request->family)->where('female_family_id', null)->first();
            if($breeder_record!=null){
                return response()->json( ['error'=>'Breeder record already exist'] );
            }
            $new_breeder = new Breeder;
            $new_breeder->family_id = $request->family;
            $new_breeder->female_family_id = null;
            $new_breeder->date_added = $request->date_added;
            $new_breeder->save();

            $new_inventory = new BreederInventory;
            $new_inventory->breeder_id = $new_breeder->id;
            $new_inventory->pen_id = $request->pen_id;
            $new_inventory->breeder_tag = $request->breeder_tag;
            $new_inventory->batching_date = null;
            $new_inventory->number_male = $request->number_male;
            $new_inventory->number_female = $request->number_female;
            $new_inventory->total = $request->number_male + $request->number_female;
            $new_inventory->last_update = $request->date_added;
            $new_inventory->save();

            $movement->save();
            $breeder_pen->save();
            return response()->json(['status' => 'success', 'message' => 'Breeder added']);
        }
    }

    public function fetchFeedingRecords ($breeder_id)
    {
        $records = BreederFeeding::where('breeder_id', $breeder_id)->orderBy('date_collected', 'desc')->paginate(15);
        return $records;
    }

    public function addFeedingRecords (Request $request)
    {
        $request->validate([
            'breeder_id' => 'required',
            'date_added' => 'required',
            'offered' => 'required',
            'refused' => 'required',
        ]);
        $record = new BreederFeeding;
        $record->breeder_id = $request->breeder_id;
        $record->date_collected = $request->date_added;
        $record->amount_offered = $request->offered;
        $record->amount_refused = $request->refused;
        $record->remarks = $request->remarks;
        $record->save();
        return response()->json(['status' => 'success', 'message' => 'Feeding record added']);
    }

    public function fetchEggProduction ($breeder_id)
    {
        $eggprod = EggProduction::where('breeder_id', $breeder_id)->orderBy('date_collected', 'desc')->paginate(15);
        return $eggprod;
    }

    public function addEggProduction(Request $request)
    {
        $request->validate([
            'breeder_id' => 'required',
            'date_added' => 'required',
            'total_eggs_intact' => 'required',
            'total_egg_weight' => 'required',
            'total_broken' => 'required',
            'total_rejects' => 'required',
        ]);
        $eggprod = new EggProduction;
        $eggprod->breeder_id = $request->breeder_id;
        $eggprod->date_collected = $request->date_added;
        $eggprod->total_eggs_intact = $request->total_eggs_intact;
        $eggprod->total_egg_weight = $request->total_egg_weight;
        $eggprod->total_broken = $request->total_broken;
        $eggprod->total_rejects = $request->total_rejects;
        $eggprod->remarks = $request->remarks;
        $eggprod->save();
        return response()->json(['status' => 'success', 'message' => 'Egg production added']);
    }

    /**
     * TODO Modify Hatchery Parameter for later user
     */

    public function getHatcheryParameter($breeder_id)
    {
        $hatchery_records = HatcheryRecord::where('breeder_id', $breeder_id)->paginate(10);
        return $hatchery_records;
    }

    public function addHatcheryParameter(Request $request)
    {
        $request->validate([
            'breeder_id' => 'required',
            'date_eggs_set' => 'required',
            'number_eggs_set' => 'required',
            'number_fertile' => 'required',
            'number_hatched' => 'required',
            'date_hatched' => 'required'
        ]);

        // $hatchery = new HatcheryRecord;
        // $hatchery->breeder_id = $request->breeder_id;
        // $hatchery->date_eggs_set = $request->date_eggs_set;
        // $hatchery->number_eggs_set = $request->number_eggs_set;
        // $hatchery->week_of_lay = Carbon::createFromFormat('Y-m-d', $request->date_eggs_set)->subDays(21)->toDateString();
        // $hatchery->number_fertile = $request->number_fertile;
        // $hatchery->number_hatched = $request->number_hatched;
        // $hatchery->date_hatched = $request->date_hatched;
        // $hatchery->batching_date = Carbon::createFromFormat('Y-m-d', $request->date_hatched)->subDays(21)->toDateString();
        // $breeder = Breeder::where('id', $request->breeder_id)->firstOrFail();
        // $brooder_record = Brooder::where('family_id', $breeder->family_id)
        // $hatchery->save();
    }


    public function dailyRecordPage()
    {
        return view('chicken.breeder.daily_record');
    }

    public function hatcheryRecordPage()
    {
        return view('chicken.breeder.hatchery_record');
    }

    public function eggQualityPage()
    {
        return view('chicken.breeder.egg_quality');
    }

    public function breederInventoryPage()
    {
        return view('chicken.breeder.breeder_inventory');
    }

    /*
    ** Helper methods for this controller
    */
    public function fetchGenerations()
    {
        $generations = Generation::where('farm_id', Auth::user()->farm_id)->where('is_active', true)->get();
        return $generations;
    }
    public function fetchLines($generation_id)
    {
        $lines = Line::where('is_active', true)->where('generation_id', $generation_id)->get();
        return $lines;
    }

    public function fetchFamilies ($line_id)
    {
        $families = Family::where('is_active', true)->where('line_id', $line_id)->get();
        return $families;
    }

    public function fetchFemaleFamilies($line_id, $male_family)
    {
        if($line_id == "" && $male_family == ""){
            return null;
        }else{
            $females = Family::where('is_active', true)
                    ->where('line_id', $line_id)
                    ->where('id', '!=', $male_family)
                    ->get();
            return $females;
        }
    }
    public function fetchBreederPens()
    {
        $pens = Pen::where('farm_id', Auth::user()->farm_id)
        ->where('is_active', true)
        ->where('current_capacity', 0)
        ->where('type', 'layer')
        ->get();
        return $pens;
    }

    public function fetchReplacementInventories ($family_id)
    {
        $replacment = Replacement::where('family_id', $family_id)->first();
        return $replacement->getInventories();
    }
}
