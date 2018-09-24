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

class BreederController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Get the generations page
     *
     * @return \Illuminate\Http\Response
     * @return collection
     */
    public function getGenerationsPage()
    {
        $generations = Generation::where('is_active', true)->orderBy('numerical_generation', 'desc')->paginate(15);
        return view('chicken.breeder.generation', compact('generations'));
    }

    public function addGeneration(Request $request)
    {
        $request->validate([
            'generation_number' => 'required'
        ]);
        $generation = new Generation;
        $generation->numerical_generation = $request->generation_number;
        $generation->number = str_pad($request->generation_number, 4, '0', STR_PAD_LEFT);
        $generation->is_active = true;
        $generation->save();
        if(!empty($request->line)){
            foreach($request->line as $line){
                $new = new Line;
                $new->number = str_pad($line, 4, '0', STR_PAD_LEFT);
                $new->is_active = true;
                $new->generation_id = $generation->id;
                $new->save();
            }
        }
        $request->session()->flash('generation-add', 'Generation successfully created');
        return redirect()->route('farm.chicken.breeder.generation');
    }
    
    public function cullGeneration(Request $request)
    {
        
    }

    public function searchGeneration(Request $request)
    {   
        $generations = Generation::where('is_active', true)
                ->where('number', 'like', '%'.$request->search.'%')
                ->paginate(15);
        return view('chicken.breeder.generation', compact('generations'));
    }

    public function addLine(Request $request)
    {
        $request->validate([
            'add_line_gen_id' => 'required',
            'add_line' => 'required'
        ]);
        if(!empty($request->add_line)){
            foreach($request->add_line as $line){
                $new = new Line;
                $new->number = str_pad($line, 4, '0', STR_PAD_LEFT);
                $new->is_active = true;
                $new->generation_id = $request->add_line_gen_id;
                $new->save();
            }
        }
        return redirect()->route('farm.chicken.breeder.generation');
    }

    public function getFamilyRecordsPage()
    {
        $generations = Generation::where('is_active', true)->get();
        $families = Family::where('is_active', true)->paginate(15);
        return view('chicken.breeder.family_record', compact('generations','families'));
    }

    public function getGenerationList()
    {
        $generations = Generation::where('is_active', true)->get();
        return $generations;
    }

    public function getLinesList($generation_id)
    {
        $lines = Line::where('generation_id', $generation_id)->where('is_active', true)->get();
        return $lines;
    }

    public function addFamilyRecord(Request $request)
    {
        $request->validate([
            'family_id' => 'required',
            'line_id' => 'required',
        ]);
        $new = new Family;
        $new->number = str_pad($request->family_id, 4, '0', STR_PAD_LEFT);
        $new->is_active = true;
        $new->line_id = $request->line_id;
        $new->save();
        
        return redirect()->route('farm.chicken.breeder.family_record');
    }

    public function searchFamilyRecordsPage(Request $request)
    {
        $families = Family::where('is_active', true)
                    ->where('number', 'like', '%'.$request->search.'%')
                    ->paginate(15);
        dd($families);
    }

    public function getFamilyRecordsPageNew()
    {
        return view('chicken.breeder.family_record_new');
    }

    public function addBreederPage()
    {
        return view('chicken.breeder.add_breeder');
    }

    public function fetchBreederFamilies()
    {
        $families = Family::join('lines', 'families.line_id', '=', 'lines.id')
                    ->join('generations', 'lines.generation_id', '=', 'generations.id')
                    ->select('families.number as family_number', 
                    'lines.number as line_number', 
                    'generations.number as generation_number', 
                    'families.*')
                    ->where('families.is_active', true)
                    ->get();
        return $families;
    }

    public function addBreeder(Request $request)
    {
        $request->validate([
            'family_id' => 'required',
            'female_family' => 'required',
            'date_added' => 'required',
            'number_male' => 'required',
            'number_female' => 'required',
            'pen_id' => 'required'
        ]);
        dd($request);
        $new = new Breeder;
        $new->family_id = $request->family_id;
        $new->female_family_id = $request->female_family;
        $new->date_added = $request->date_added;
        $new->save();
        
        return response()->json(['status' => 'success', 'message' => 'Breeders added']);
    }

    public function addBreederExternal(Request $request) 
    {
        $request->validate([
            'family_id' => 'required',
            'date_added' => 'required',
            'number_male' => 'required',
            'number_female' => 'required',
            'pen_id' => 'required',
        ]);
        $new = new Breeder;
        $new->family_id = $request->family_id;
        $new->female_family_id = null;
        $new->date_added = $request->date_added;
        $new->save();
        $inventory = new BreederInventory;
        $inventory->breeder_id = $new->id;
        $inventory->pen_id = $request->pen_id;
        $inventory->date_removed = null;
        $inventory->number_male = $request->number_male;
        $inventory->number_female = $request->number_female;
        $inventory->total = $request->number_male + $request->number_female;
        $inventory->activity = "Add External Source Breeders";
        $inventory->reason = null;
        $inventory->save();
        $pen = Pen::where('id', $request->pen_id)->first();
        $pen->current_capacity = $pen->current_capacity + $inventory->total;
        $pen->save();
        return response()->json(['status' => 'success', 'message' => 'Breeders added']);
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
        $generations = Generation::where('is_active', true)->get();
        return $generations;
    }
    public function fetchLines($generation_id) 
    {
        if($generation_id == ""){
            $lines = Line::where('is_active', true)->get();
            return $lines;
        }else{
            $lines = Line::where('is_active', true)->where('generation_id', $generation_id)->get();
            return $lines;
        }
        
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
        $pens = Pen::where('is_active', true)
                    ->where('type', 'layer')
                    ->where('current_capacity', '==', 0)
                    ->get();
        return $pens;
    }
}
