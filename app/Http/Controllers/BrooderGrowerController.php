<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Generation;
use App\Models\Line;
use App\Models\Family;
use App\Models\Pen;
use App\Models\BrooderGrower;
use App\Models\BrooderGrowerInventory;
use App\Models\BrooderGrowerFeeding;
use App\Models\BrooderGrowerGrowth;

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

    public function getBrooderGrower ()
    {
        $broodergrowers = BrooderGrower::join('families', 'families.id', 'brooder_growers.family_id')
                ->join('lines', 'lines.id', 'families.line_id')
                ->join('generations', 'generations.id', 'lines.generation_id')
                ->join('brooder_grower_inventories', 'brooder_grower_inventories.broodergrower_id', 'brooder_growers.id')
                ->select('brooder_growers.*', 'brooder_grower_inventories.*', 'families.number as family_number',
                'lines.number as line_number', 'generations.number as generation_number')
                ->paginate(8);
        return $broodergrowers;
    }

    public function addBrooderGrower(Request $request)
    {
        $request->validate([
            'family_id' => 'required',
            'date_added' => 'required',
            'batching_date' => 'required',
            'total' => 'required',
            'pen_id' => 'required',
        ]);
        $new = new BrooderGrower;
        $new->family_id = $request->family_id;
        $new->pen_id = $request->pen_id;
        $new->batching_date = $request->batching_date;
        $new->date_added = $request->date_added;
        $new->save();

        $inventory = new BrooderGrowerInventory;
        $inventory->broodergrower_id = $new->id;
        $inventory->data_completion = $inventory->data_completion + 1;
        $inventory->number_male = null;
        $inventory->number_female = null;
        $inventory->total = $request->total;
        $inventory->last_update = $request->date_added;
        $inventory->save();

        $family = Family::where('id', $request->family_id)->firstOrFail();
        $family->broodergrower = true;
        $family->save();

        $pen = Pen::where('id', $request->pen_id)->firstOrFail();
        $pen->current_capacity = $pen->current_capacity + $request->total;
        $pen->save();

        return response()->json(['status' => 'success', 'message' => 'Brooder & Grower added']);
    }

    public function updateBrooderGrower(Request $request)
    {
        $request->validate([
            'broodergrower_id' => 'required',
            'male' => 'required',
            'female' => 'required',
            'date_updated' => 'required'
        ]);
        $broodergrower = BrooderGrowerInventory::where('broodergrower_id', $request->broodergrower_id)->firstOrFail();
        $broodergrower->data_completion = $broodergrower->data_completion + 1;
        $broodergrower->number_male = $request->male;
        $broodergrower->number_female = $request->female;
        $broodergrower->last_update = $request->date_updated;
        $broodergrower->save();
        return response()->json(['status' => 'success', 'message' => 'Brooder & Grower updated']);
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
            'broodergrower_id' => 'required',
            'date_collected' => 'required',
            'offered' => 'required',
            'refused' => 'required',
        ]);

        $feeding = new BrooderGrowerFeeding;
        $feeding->broodergrower_id = $request->broodergrower_id;
        $feeding->date_collected  = $request->date_collected;
        $feeding->amount_offered  = $request->offered;
        $feeding->amount_refused = $request->refused;
        $feeding->remarks = $request->remarks;
        $feeding->save();

        return response()->json(['status' => 'success', 'message' => 'Feeding Records added']);
    }

    public function getGrowthRecord()
    {
        return view('chicken.broodergrower.growthrecord');
    }

    public function fetchGrowthRecords($broodergrower_id)
    {
        $growthrecords = BrooderGrowerGrowth::where('broodergrower_id', $broodergrower_id)->orderBy('date_collected', 'desc')->paginate(10);
        return $growthrecords;
    }

    public function addGrowthRecord(Request $request)
    {
        if($request->sexing){
            $request->validate([
                'broodergrower_id' => 'required',
                'date_added' => 'required',
                'collection_day' => 'required',
                'male_number' => 'required',
                'female_number' => 'required',
                'male_weight' => 'required',
                'female_weight' => 'required',
            ]);
            $new = new BrooderGrowerGrowth;
            $new->broodergrower_id = $request->broodergrower_id;
            $new->date_collected = $request->date_added;
            $new->collection_day = $request->collection_day;
            $new->male_quantity = $request->male_number;
            $new->male_weight = $request->male_weight;
            $new->female_quantity = $request->female_number;
            $new->female_weight = $request->female_weight;
            $new->total_quantity = $request->male_number + $request->female_number;
            $new->total_weight = $request->male_weight + $request->female_weight;
            $new->save();
        }else{
            $request->validate([
                'broodergrower_id' => 'required',
                'date_added' => 'required',
                'collection_day' => 'required',
                'total_number' => 'required',
                'total_weight' => 'required',
            ]);
            $new = new BrooderGrowerGrowth;
            $new->broodergrower_id = $request->broodergrower_id;
            $new->date_collected = $request->date_added;
            $new->collection_day = $request->collection_day;
            $new->male_quantity = null;
            $new->male_weight = null;
            $new->female_quantity = null;
            $new->female_weight = null;
            $new->total_quantity = $request->total_number;
            $new->total_weight = $request->total_weight;
            $new->save();
        }

        return response()->json(['status' => 'success', 'message' => 'Growth Records added']);
    }

    /*
    * * Helper function
    * TODO: Refactor some of the codes for better queries
    */
    public function fetchGenerations ()
    {
        $generations = Generation::where('is_active', true)->get();
        return $generations;
    }

    public function fetchLines ($generation_id)
    {
        $lines = Line::where('is_active', true)->where('generation_id', $generation_id)->get();
        return $lines;
    }

    public function fetchFamilies ($line_id)
    {
        $families = Family::where('is_active', true)->where('line_id', $line_id)->where('broodergrower', false)->get();
        return $families;
    }

    public function fetchPens ()
    {
        $pens = Pen::where('is_active', true)->where('type', 'brooder')->where('current_capacity', 0)->get();
        return $pens;
    }
}
