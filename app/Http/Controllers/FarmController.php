<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Pen;
use App\Models\Generation;
use App\Models\Line;
use App\Models\Family;

class FarmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.dashboard');
    }

    /**
     * Show the pens list page
     * @param none
     * @return view
     * @return collection
     */    
    public function getPensPage()
    {
        $pens = Pen::where('is_active', true)->orderBy('type', 'asc')->paginate(15);
        return view('general.pens', compact('pens'));
    }
    
    /**
     * Post created pen to database
     * @param request
     * @return redirect
     */    
    public function addPen(Request $request)
    {
        $request->validate([
            'pen_number' => 'required',
            'type' => 'required',
            'pen_capacity' => 'required',
        ]);
        $new = new Pen;
        if($request->type === "brooder"){
            $new->number = "B".str_pad($request->pen_number, 2, '0', STR_PAD_LEFT);
        }elseif($request->type === "grower"){
            $new->number = "G".str_pad($request->pen_number, 2, '0', STR_PAD_LEFT);
        }elseif($request->type === "layer"){
            $new->number = "L".str_pad($request->pen_number, 2, '0', STR_PAD_LEFT);
        }
        $new->type = $request->type;
        $new->total_capacity = $request->pen_capacity;
        $new->current_capacity = 0;
        $new->save();
        $request->session()->flash('pen-create', 'Pen successfully created');
        return redirect()->route('farm.pens');
    }

    /**
     * Search pens from search request
     * @param request
     * @return view
     * @return collection
     */
    public function searchPen(Request $request)
    {
        if($request->search == null && $request->search_checkbox == null){
            return redirect()->route('farm.pens');
        }else{
            if($request->search_checkbox == null){
                $pens = Pen::where('is_active', true)
                ->where('number', 'like', '%'.$request->search.'%')
                ->paginate(15);
                return view('general.pens', compact('pens'));
            }else{
                $pens = Pen::where('is_active', true)
                ->where('number', 'like', '%'.$request->search.'%')
                ->whereIn('type', $request->search_checkbox)
                ->paginate(15);
                return view('general.pens', compact('pens'));
            }
        }
    }

    /**
     * Get farm settings page
     * @param none
     * @return view
     * @return variable
     */
    public function getFarmSettingPage()
    {
        if (Auth::check())
        {
            $farm = Auth::user()->getFarm();
            return view('general.farm_settings', compact('farm'));
        }
    }

    /**
     * Edit farm attributes
     * @param request
     * @return view
     * @return parameter
     */
    public function editFarmSetting(Request $request)
    {
        if (Auth::check())
        {
            $farm = Auth::user()->getFarm();
            if(!is_null($request->farm_name)){
                $farm->name = $request->farm_name;
            }
            if(!is_null($request->farm_address)){
                $farm->address = $request->farm_address;
            }
            if(!is_null($request->farm_batching_week) && $request->farm_batching_week>0 && $request->farm_batching_week <= 10){
                $farm->batching_week = $request->farm_batching_week;
            }
            $farm->save();
            return redirect()->back()->with('success', ['Farm settings edit successful']);   
        }
        else{
            return redirect()->back()->with('fail', ['Farm settings edit failed']); 
        }
    }

    /**
     * Get Generations
     * @param request
     * @return view
     */    

    public function getGenerationLinesPage()
    {
        return view('general.generation_lines');
    }

    /**
     * Add Generations
     * @param request
     * @return response
     */
    public function addGeneration(Request $request)
    {
        $request->validate([
            'generation_number' => 'required',
        ]);
        $generation = new Generation;
        $generation->number = str_pad($request->generation_number, 4, '0', STR_PAD_LEFT);
        $generation->numerical_generation = $request->generation_number;
        $generation->is_active = true;
        $generation->save();

        return response()->json(['status' => 'success', 'message' => 'Generation added']);
    }

    /**
     * Add Lines
     * @param request
     * @return response
     */
    public function addLineToGeneration(Request $request)
    {
        $request->validate([
            'line_number' => 'required',
            'generation_number' => 'required',
        ]);
        $new = new Line;
        $new->number = str_pad($request->line_number, 4, '0', STR_PAD_LEFT);
        $new->generation_id = $request->generation_number;
        $new->is_active = true;
        $new->save();

        return response()->json(['status' => 'success', 'message' => 'Line added']);
    }

    /**
     * Fetch Generations
     * @param request
     * @return data
     */
    public function fetchGenerations()
    {
        $generations = Generation::where('is_active', true)->get();
        return $generations;
    }

    public function fetchLinesInGeneration($generation)
    {
        $lines = Line::where('generation_id', $generation)->where('is_active', true)->get();        
        return $lines;
    }

    /**
     * Show Generation Details
     * @param var
     * @return data
     */
    public function showGenerationDetails($generation)
    {
        $lines = Line::where('generation_id', $generation)->where('is_active', true)->get();        
        return $lines;
    }

    /**
     * Search Generation Number
     * @param request
     * @return data
     */
    public function searchGeneration($search)
    {
        $generations = Generation::where('number', 'like', '%'.$search.'%')->where('is_active', true)->get();        
        return $generations;
    }

    public function getFamilyRecordsPage()
    {
        return view('general.family_records');
    }

    public function fetchFamilies()
    {
        $families = Family::
        join('lines', 'families.line_id', '=', 'lines.id')
        ->where('families.is_active', true)
        ->select('lines.number AS line_number', 'families.number AS family_number', 'families.is_active as is_active')
        ->get();
        return $families;
    }

    public function addFamilyRecord(Request $request)
    {
        $request->validate([
            'family_number' => 'required',
            'line_id' => 'required',
        ]);

        $new = new Family;
        $new->number = str_pad($request->family_number, 4, '0', STR_PAD_LEFT);
        $new->line_id = $request->line_id;
        $new->is_active = true;
        $new->save();
        return response()->json(['status' => 'success', 'message' => 'Family added']);
    }

    public function searchFamily($search)
    {
        $families = Family::join('lines', 'families.line_id', '=', 'lines.id')
        ->where('families.is_active', true)
        ->where('families.number', 'like', '%'.$search.'%')
        ->select('lines.number AS line_number', 'families.number AS family_number', 'families.is_active as is_active')
        ->get();
        return $families;
    }
}
