<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Replacement;
use App\Models\Generation;
use App\Models\Line;
use App\Models\Family;
use App\Models\Pen;
use App\Models\ReplacementInventory;
use App\Models\AnimalMovement;
use App\Models\BrooderGrower;
use App\Models\BrooderGrowerInventory;

class ReplacementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAddReplacement()
    {
        return view('chicken.replacement.add_replacement');
    }

    public function getReplacementList()
    {
        $replacements = Replacement::join('families', 'families.id', 'replacements.family_id')
                        ->join('lines', 'lines.id', 'families.line_id')
                        ->join('generations', 'generations.id', 'lines.generation_id')
                        ->select('replacements.*', 'families.number as family_number',
                        'lines.number as line_number', 'generations.number as generation_number')
                        ->paginate(8);
        return $replacements;
    }

    public function addReplacements(Request $request)
    {
        $request->validate([
            'family_id' => 'required',
            'date_added' => 'required',
            'number_male' => 'required',
            'number_female' => 'required',
            'pen_id' => 'required',
            'external' => 'required'
        ]);
        if($request->external){
            $new = new Replacement;
            $new->batching_date = null;
            $new->family_id = $request->family_id;
            $new->date_added = $request->date_added;
            $new->pen_id = $request->pen_id;

            $movement = new AnimalMovement;
            $movement->date = $request->date_added;
            $movement->family_id = $request->family_id;
            $movement->pen_id = $request->pen_id;
            $movement->type = "replacement";
            $movement->activity = "add replacement external";
            $movement->price = null;
            $movement->number_male = $request->number_male;
            $movement->number_female = $request->number_female;
            $movement->number_total = $movement->number_male + $movement->number_female;
            $movement->remarks = null;


            $family = Family::where('id', $request->family_id)->first();
            $family->replacement = true;


            $pen = Pen::where('id', $request->pen_id)->first();
            $pen->current_capacity = $pen->current_capacity + ($request->number_male + $request->number_female);

            $new->save();

            $inventory = new ReplacementInventory;
            $inventory->replacement_id = $new->id;
            $inventory->number_male = $request->number_male;
            $inventory->number_female = $request->number_female;
            $inventory->total = $inventory->number_male + $inventory->number_female;
            $inventory->last_update = $request->date_added;

            $inventory->save();
            $movement->save();
            $family->save();
            $pen->save();

            return response()->json(['status' => 'success', 'message' => 'Replacement added']);
        }else{
            $new = new Replacement;
            $new->batching_date = null;
            $new->family_id = $request->family_id;
            $new->date_added = $request->date_added;
            $new->pen_id = $request->pen_id;

            $movement = new AnimalMovement;
            $movement->date = $request->date_added;
            $movement->family_id = $request->family_id;
            $movement->pen_id = $request->pen_id;
            $movement->type = "replacement";
            $movement->activity = "add replacement internal";
            $movement->price = null;
            $movement->number_male = $request->number_male;
            $movement->number_female = $request->number_female;
            $movement->number_total = $movement->number_male + $movement->number_female;
            $movement->remarks = null;

            $family = Family::where('id', $request->family_id)->firstOrFail();
            $family->replacement = true;

            $pen = Pen::where('id', $request->pen_id)->firstOrFail();
            $pen->current_capacity = $pen->current_capacity + ($request->number_male + $request->number_female);

            // update affected brooder
            $brooderGrower = BrooderGrower::where('family_id', $request->family_id)->firstOrFail();
            $brooderGrowerInventory = BrooderGrowerInventory::where('broodergrower_id', $brooderGrower->id)->firstOrFail();
            $brooderGrowerInventory->number_male = $brooderGrowerInventory->number_male - $request->number_male;
            $brooderGrowerInventory->number_female = $brooderGrowerInventory->number_female - $request->number_female;
            $brooderGrowerInventory->total = $brooderGrowerInventory->number_male + $brooderGrowerInventory->number_female;
            $brooderGrowerInventory->last_update = $request->date_added;

            // update pen of brooder
            $brooderPen = Pen::where('id', $brooderGrower->pen_id)->firstOrFail();
            $brooderPen->current_capacity = $brooderPen->current_capacity + ($request->number_male + $request->number_female);

            // record the animal movement
            $brooderMovement = new AnimalMovement;
            $brooderMovement->date = $request->date_added;
            $brooderMovement->family_id = $brooderGrower->family_id;
            $brooderMovement->pen_id = $brooderGrower->pen_id;
            $brooderMovement->type = "broodersgrowers";
            $brooderMovement->activity = "move broodergrowers";
            $brooderMovement->price = null;
            $brooderMovement->number_male = $request->number_male;
            $brooderMovement->number_female = $request->number_female;
            $brooderMovement->number_total = $request->number_male + $request->number_female;
            $brooderMovement->remarks = null;

            $new->save();

            $inventory = new ReplacementInventory;
            $inventory->replacement_id = $new->id;
            $inventory->number_male = $request->number_male;
            $inventory->number_female = $request->number_female;
            $inventory->total = $inventory->number_male + $inventory->number_female;
            $inventory->last_update = $request->date_added;

            $inventory->save();
            $movement->save();
            $family->save();
            $pen->save();
            $brooderGrowerInventory->save();
            $brooderPen->save();
            $brooderMovement->save();
        }

    }

    public function searchReplacements($search)
    {
        $replacements = Replacement::join('families', 'families.id', 'replacements.family_id')
                        ->join('lines', 'lines.id', 'families.line_id')
                        ->join('generations', 'generations.id', 'lines.generation_id')
                        ->select('replacements.*', 'families.number as family_number',
                        'lines.number as line_number', 'generations.number as generation_number')
                        ->where('families.number', 'like', '%'.$search.'%')
                        ->paginate(8);
        return $replacements;
    }

    public function phenoMorphoPage()
    {
        return view('chicken.replacement.phenomorpho_record');
    }

    public function feedingRecordPage()
    {
        return view('chicken.replacement.feeding_record');
    }

    public function addPhenoMorphoPage($family_id)
    {
        $family = Family::where('id', $family_id)->select('replacement')->first();
        if($family->replacement == false){
            return back()->withInput();
        }else{
            return view('chicken.replacement.phenomorpho_record');
        }

    }

    /*
    **  Helper Functions
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
        $families = Family::where('is_active', true)->where('line_id', $line_id)->where('replacement', false)->get();
        return $families;
    }

    public function fetchPens ()
    {
        $pens = Pen::where('is_active', true)
                    ->where('type', 'grower')
                    ->where('current_capacity', '==', 0)
                    ->get();
        return $pens;
    }
}
