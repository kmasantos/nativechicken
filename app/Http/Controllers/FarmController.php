<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Farm;
use App\Models\Pen;
use App\Models\Generation;
use App\Models\Line;
use App\Models\Family;

use App\Models\Breeder;
use App\Models\BreederInventory;
use App\Models\Replacement;
use App\Models\ReplacementInventory;
use App\Models\BrooderGrower;
use App\Models\BrooderGrowerInventory;

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
        $farm = Farm::where('id', Auth::user()->farm_id)->firstOrFail();
        if($farm->batching_week < 0){
            return view('general.set_batching');
        }
        return view('general.dashboard');
    }

    public function getDashData()
    {

    }

    public function cullGeneration($generation_id)
    {
        $generation = Generation::where('id', $generation_id)->first();
        $generation->is_active = false;
        $generation->save();
        $lines = Line::where('generation_id', $generation->id)->get();
        foreach($lines as $line){
            $families = Family::where('line_id', $line->id)->get();
            foreach($families as $family){
                $breeders = Breeder::where('family_id', $family->id)->get();
                foreach($breeders as $breeder){
                    $inventories = BreederInventory::where('breeder_id', $breeder->id)->get();
                    foreach($inventories as $inventory){
                        $pen = Pen::where('id', $inventory->pen_id)->first();
                        if($pen->current_capacity != 0){
                            $pen->current_capacity = 0;
                            $pen->save();
                        }
                        $inventory->delete();
                    }
                    $breeder->delete();
                }

                $replacements = Replacement::where('family_id', $family->id)->get();
                foreach($replacements as $replacement){
                    $inventories = ReplacementInventory::where('replacement_id', $replacement->id)->get();
                    foreach($inventories as $inventory){
                        $pen = Pen::where('id', $inventory->pen_id)->first();
                        if($pen->current_capacity != 0){
                            $pen->current_capacity = 0;
                            $pen->save();
                        }
                        $replacement->delete();
                    }
                    $breeder->delete();
                }

                $brooders = BrooderGrower::where('family_id', $family->id)->get();
                foreach($brooders as $brooder){
                    $inventories = BrooderGrowerInventory::where('broodergrower_id', $brooder->id)->get();
                    foreach($inventories as $inventory){
                        $pen = Pen::where('id', $inventory->pen_id)->first();
                        if($pen->current_capacity != 0){
                            $pen->current_capacity = 0;
                            $pen->save();
                        }
                        $inventory->delete();
                    }
                    $brooder->delete();
                }

                $family->is_active = false;
                $family->save();
            }
            $line->is_active = false;
            $line->save();
        }
        return response()->json(['status' => 'success', 'message' => 'Generation culled']);
    }

    /**
     *  Test Page for Element UI
     *
     * @return \Illuminate\Http\Response
     */
    public function testPage()
    {
        return view('general.test');
    }

    public function setBatching(Request $request)
    {
        $request->validate([
            'batching_week' => 'required'
        ]);

        $farm = Farm::where('id', Auth::user()->farm_id)->firstOrFail();
        $farm->batching_week = $request->batching_week;
        $farm->save();
        return view('general.dashboard');
    }

    /*
    * *Helper Methods
    */
    public function fetchPens()
    {
        $pens = Pen::where('farm_id', Auth::user()->farm_id)->where('is_active', true)
        ->orderBy('type', 'asc')
        ->orderBy('number', 'asc')
        ->paginate(10);
        return $pens;
    }

    public function fetchGenerations()
    {
        $generations = Generation::where('farm_id', Auth::user()->farm_id)->where('is_active', true)->orderBy('numerical_generation', 'asc')->get();
        return $generations;
    }

    public function fetchLines()
    {
        $lines = Line::where('generation_id', $generation)->where('is_active', true)->get();
        return $lines;
    }

    /**
     * Show the pens list page
     * @param none
     * @return view
     * @return collection
     */
    public function getPensPage()
    {
        return view('general.pens');
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
        $request->pen_number = str_pad($request->pen_number, 2, '0', STR_PAD_LEFT);
        $exists = Pen::where('farm_id', Auth::user()->farm_id)->where('number', 'like', '%'.$request->pen_number)->where('type', $request->type)->first();
        if($exists != null){
            return response()->json( ['error'=>'Pen number already exist'] );
        }

        $new = new Pen;
        $new->farm_id = Auth::user()->farm_id;
        if($request->type === "brooder"){
            $new->number = "B".$request->pen_number;
        }elseif($request->type === "grower"){
            $new->number = "G".$request->pen_number;
        }elseif($request->type === "layer"){
            $new->number = "L".$request->pen_number;
        }
        $new->type = $request->type;
        $new->total_capacity = $request->pen_capacity;
        $new->current_capacity = 0;
        $new->save();

        return response()->json(['status' => 'success', 'message' => $new->number]);
    }

    /**
     * Search pens from search request
     * @param request
     * @return view
     * @return collection
     */
    public function searchPen($search_array)
    {
        $number = json_decode($search_array)[0];
        $type = json_decode($search_array)[1];
        if($number == null && $type == null){
            return;
        }else{
            if($type == null){
                $pens = Pen::where('farm_id', Auth::user()->farm_id)
                ->where('is_active', true)
                ->where('number', 'like', '%'.$number.'%')
                ->orderBy('type', 'asc')
                ->orderBy('number', 'asc')
                ->paginate(10);
                return $pens;
            }else{
                $pens = Pen::where('farm_id', Auth::user()->farm_id)
                ->where('is_active', true)
                ->where('number', 'like', '%'.$number.'%')
                ->whereIn('type', $type)
                ->orderBy('type', 'asc')
                ->orderBy('number', 'asc')
                ->paginate(10);
                return $pens;
            }
        }
    }

    public function editPen(Request $request)
    {
        $pen = Pen::where('id', $request->pen_id)->firstOrFail();
        if($request->pen_number != null){
            $pen->number = $request->pen_number;
        }
        if($request->pen_capacity!=null){
            if($request->pen_capacity >= $pen->current_capacity){
                $pen->total_capacity = $request->pen_capacity;
            }
        }
        $pen->save();
        return response()->json(['status' => 'success', 'message' => $pen->number]);
    }

    public function deletePen($pen_id)
    {
        $pen = Pen::where('id', $pen_id)->firstOrFail();
        $number = $pen->number;
        if($pen->current_capacity > 0){
            return response()->json( ['error'=>'Pen contents not equal to 0'] );
        }else{
            $pen->delete();
        }

        return response()->json(['status' => 'success', 'message' => $number]);
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
        $request->generation_number = str_pad($request->generation_number, 4, '0', STR_PAD_LEFT);
        $exists = Generation::where('farm_id', Auth::user()->farm_id)->where('number', 'like', $request->generation_number)->first();
        if($exists!=null){
            return response()->json( ['error'=>'Generation number already exist'] );
        }
        $generation = new Generation;
        $generation->farm_id = Auth::user()->farm_id;
        $generation->number = $request->generation_number;
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
        $request->line_number = str_pad($request->line_number, 4, '0', STR_PAD_LEFT);
        $exists = Line::where('generation_id', $request->generation_number)->where('number', 'like', $request->line_number)->first();
        if($exists!=null){
            return response()->json( ['error'=>'Line number already exist'] );
        }
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
    public function getGenerations()
    {
        $generations = Generation::where('farm_id', Auth::user()->farm_id)
        ->orderBy('numerical_generation', 'desc')
        ->paginate(10);

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
        $lines = Line::where('generation_id', $generation)->orderBy('number', 'asc')->get();
        return $lines;
    }

    /**
     * Search Generation Number
     * @param request
     * @return data
     */
    public function searchGeneration($search)
    {
        $generations = Generation::where('farm_id', Auth::user()->farm_id)
        ->where('number', 'like', '%'.$search.'%')
        ->orderBy('numerical_generation', 'desc')
        ->paginate(10);
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
        ->join('generations', 'lines.generation_id', '=', 'generations.id')
        ->where('generations.farm_id', Auth::user()->farm_id)
        ->where('families.is_active', true)
        ->select('lines.number AS line_number', 'families.number AS family_number',
        'families.is_active as is_active', 'generations.number AS generation_number')
        ->orderBy('generations.number', 'desc')
        ->orderBy('lines.number', 'desc')
        ->orderBy('families.number', 'asc')
        ->paginate(10);
        return $families;
    }

    public function addFamilyRecord(Request $request)
    {
        $request->validate([
            'family_number' => 'required',
            'line_id' => 'required',
        ]);
        $request->family_number = str_pad($request->family_number, 4, '0', STR_PAD_LEFT);
        $exists = Family::where('line_id', $request->line_id)->where('number', 'like', $request->family_number)->first();
        if($exists!=null){
            return response()->json( ['error'=>'Family number already exist'] );
        }
        $new = new Family;
        $new->number = $request->family_number;
        $new->line_id = $request->line_id;
        $new->is_active = true;
        $new->save();
        return response()->json(['status' => 'success', 'message' => 'Family added']);
    }

    public function searchFamily($search)
    {
        $families = Family::join('lines', 'families.line_id', '=', 'lines.id')
        ->join('generations', 'lines.generation_id', '=', 'generations.id')
        ->where('generations.farm_id', Auth::user()->farm_id)
        ->where('families.is_active', true)
        ->where('families.number', 'like', '%'.$search.'%')
        ->select('lines.number AS line_number', 'families.number AS family_number',
        'families.is_active as is_active', 'generations.number AS generation_number')
        ->orderBy('generations.number', 'desc')
        ->paginate(10);
        return $families;
    }
}
