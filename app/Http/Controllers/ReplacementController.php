<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Replacement;
use App\Models\Generation;
use App\Models\Line;
use App\Models\Family;
use App\Models\Pen;
use App\Models\ReplacementInventory;

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
            $new->save();
            $inventory = new ReplacementInventory;
            $inventory->replacement_id = $new->id;
            $inventory->number_male = $request->number_male;
            $inventory->number_female = $request->number_female;
            $inventory->total = $inventory->number_male + $inventory->number_female;
            $inventory->activity = "Add replacements from external source";
            $inventory->pen_id = $request->pen_id;
            $inventory->date = $request->date_added;
            $inventory->save();
            $family = Family::where('id', $request->family_id)->first();
            $family->replacement = true;
            $family->save();
            $pen = Pen::where('id', $request->pen_id)->first();
            $pen->current_capacity = $pen->current_capacity + $inventory->total;
            $pen->save();
            return "Ok";
        }else{
            dd($request);        
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
