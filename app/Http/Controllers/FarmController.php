<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
use App\Models\BreederFeeding;
use App\Models\ReplacementFeeding;
use App\Models\BrooderGrowerFeeding;
use App\Models\HatcheryRecord;
use App\Models\EggQuality;
use App\Models\EggProduction;
use App\Models\MortalitySale;
use App\Models\PhenoMorpho;
use App\Models\PhenoMorphoValue;

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
        $now = Carbon::now()->toDateString();
        $month_start = new Carbon('first day of this month');
        $month_end = new Carbon('last day of this month');
        $month_start = $month_start->toDateString();
        $month_end = $month_end->toDateString();
        $male = 0;
        $female = 0;
        $total = 0;
        $breeder_feeding = 0;
        $replacement_feeding = 0;
        $brooder_feeding = 0;
        $total_eggs_hatched = 0;
        $total_eggs_set = 0;
        $total_eggs_fertile = 0;
        $percent_fertility = 0;
        $percent_hatchability = 0;
        $percent_hen_day = 0;
        $eggs_collected = 0;
        $total_egg_weight = 0;
        $total_rejected = 0;
        $breeder_mortality = 0;
        $breeder_sales = 0;
        $breeder_egg_sales = 0;
        $replacement_mortality = 0;
        $replacement_sales = 0;
        $replacement_egg_sales = 0;
        $brooder_mortality = 0;
        $brooder_sales = 0;

        $farm = Auth::user()->getFarm();
        $generations = Generation::where('farm_id', $farm->id)->where('is_active', true)->get();
        foreach($generations as $generation){
            $lines = $generation->getLines();
            foreach($lines as $line){
                $families = Family::where('line_id', $line->id)->where('is_active', true)->get();
                foreach($families as $family){
                    $breeders = Breeder::where('family_id', $family->id)->get();
                    foreach($breeders as $breeder){
                        $inventories = BreederInventory::where('breeder_id', $breeder->id)->get();
                        $male = $male + $inventories->sum('number_male');
                        $female = $female + $inventories->sum('number_female');
                        $total = $total + $inventories->sum('total');
                        foreach($inventories as $inventory){
                            $breeder_feeding = $breeder_feeding + BreederFeeding::where('breeder_inventory_id', $inventory->id)->whereBetween('date_collected', [$month_start, $month_end])->get()->sum('amount_offered');
                            $total_eggs_set = $total_eggs_set + HatcheryRecord::where('breeder_inventory_id', $inventory->id)->whereBetween('date_eggs_set', [$month_start, $month_end])->get()->sum('number_eggs_set');
                            $total_eggs_hatched = $total_eggs_hatched + HatcheryRecord::where('breeder_inventory_id', $inventory->id)->whereBetween('date_eggs_set', [$month_start, $month_end])->get()->sum('number_hatched');
                            $total_eggs_fertile = $total_eggs_fertile + HatcheryRecord::where('breeder_inventory_id', $inventory->id)->whereBetween('date_eggs_set', [$month_start, $month_end])->get()->sum('number_fertile');
                            $eggs_collected = $eggs_collected + EggProduction::where('breeder_inventory_id', $inventory->id)->whereBetween('date_collected', [$month_start, $month_end])->get()->sum('total_eggs_intact');
                            $total_egg_weight = $total_egg_weight + EggProduction::where('breeder_inventory_id', $inventory->id)->whereBetween('date_collected', [$month_start, $month_end])->get()->sum('total_egg_weight');
                            $total_rejected = $total_rejected + EggProduction::where('breeder_inventory_id', $inventory->id)->whereBetween('date_collected', [$month_start, $month_end])->get()->sum('total_rejects');
                            $breeder_mortality = $breeder_mortality + MortalitySale::where('breeder_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'died')->get()->sum('total');
                            $breeder_sales = $breeder_sales + MortalitySale::where('breeder_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'sold')->where('type', 'breeder')->get()->sum('total');
                            $breeder_egg_sales = $breeder_egg_sales + MortalitySale::where('breeder_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'sold')->where('type', 'egg')->get()->sum('total');
                        }
                    }
                    $replacements = Replacement::where('family_id', $family->id)->get();
                    foreach($replacements as $replacement){
                        $inventories = BreederInventory::where('replacement_id', $replacement->id)->get();
                        $male = $male + $inventories->sum('number_male');
                        $female = $female + $inventories->sum('number_female');
                        $total = $total + $inventories->sum('total');
                        foreach($inventories as $inventory){
                            $replacement_feeding = $replacement_feeding + ReplacementFeeding::where('replacement_inventory_id', $inventory->id)->whereBetween('date_collected', [$month_start, $month_end])->get()->sum('amount_offered');
                            $replacement_mortality = $replacement_mortality + MortalitySale::where('replacement_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'died')->get()->sum('total');
                            $replacement_sales = $replacement_sales + MortalitySale::where('replacement_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'sold')->where('type', 'replacement')->get()->sum('total');
                            $replacement_egg_sales = $replacement_egg_sales + MortalitySale::where('replacement_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'sold')->where('type', 'egg')->get()->sum('total');
                        }
                    }
                    $brooders = BrooderGrower::where('family_id', $family->id)->get();
                    foreach($brooders as $brooder){
                        $inventories = BreederInventory::where('replacement_id', $brooder->id)->get();
                        $male = $male + $inventories->sum('number_male');
                        $female = $female + $inventories->sum('number_female');
                        $total = $total + $inventories->sum('total');
                        foreach($inventories as $inventory){
                            $brooder_feeding = $brooder_feeding + BrooderGrowerFeeding::where('broodergrower_inventory_id', $inventory->id)->whereBetween('date_collected', [$month_start, $month_end])->get()->sum('amount_offered');
                            $brooder_mortality = $brooder_mortality + MortalitySale::where('brooder_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'died')->get()->sum('total');
                            $brooder_sales = $brooder_sales + MortalitySale::where('brooder_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'sold')->where('type', 'brooder')->get()->sum('total');
                        }
                    }
                }
            }
        }
        if($total_eggs_set!=0){
            $percent_fertility = $total_eggs_fertile/$total_eggs_set;
        }
        if($total_eggs_fertile!=0){
            $percent_hatchability = $total_eggs_hatched/$total_eggs_fertile;
        }
        // $percent_hen_day = 0;
        $collection = collect([
            'male' => $male,
            'female' => $female,
            'total'=> $total,
            'breeder_feeding' => $breeder_feeding,
            'replacement_feeding'=> $replacement_feeding,
            'brooder_feeding'=> $brooder_feeding,
            'percent_fertility'=> $percent_fertility,
            'percent_hatchability'=> $percent_hatchability,
            'percent_hen_day'=> $percent_hen_day,
            'eggs_collected'=> $eggs_collected,
            'total_egg_weight'=> $total_egg_weight,
            'total_rejected'=> $total_rejected,
            'breeder_mortality' => $breeder_mortality,
            'breeder_sales' => $breeder_sales,
            'breeder_egg_sales' => $breeder_egg_sales,
            'replacement_mortality' => $replacement_mortality,
            'replacement_sales' => $replacement_sales,
            'replacement_egg_sales' => $replacement_egg_sales,
            'brooder_mortality' => $brooder_mortality,
            'brooder_sales' => $brooder_sales,
        ]);
        return $collection;
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

    public function farmRecords()
    {
        return view('general.farm_records');
    }
    
    public function generationSummary() 
    {
        // summary across generations

    }
    
    public function familySummary($generation) 
    {
        // summary for families per generation
        $breeders = Generation::join('lines', 'lines.generation_id', 'generations.id')
        ->where('generations.id', $generation)
        ->join('families', 'families.line_id', 'lines.id')
        ->join('breeders', 'families.id', 'breeders.family_id')
        ->join('breeder_inventories', 'breeders.id', 'breeder_inventories.breeder_id')
        ->join('pheno_morphos', 'pheno_morphos.breeder_inventory_id', 'breeder_inventories.id')
        ->join('pheno_morpho_values', 'pheno_morpho_values.id', 'pheno_morphos.values_id')
        ->withTrashed()->get();
        
        $replacements = Generation::join('lines', 'lines.generation_id', 'generations.id')
        ->where('generations.id', $generation)
        ->join('families', 'families.line_id', 'lines.id')
        ->join('replacements', 'families.id', 'replacements.family_id')
        ->join('replacement_inventories', 'replacements.id', 'replacement_inventories.replacement_id')
        ->join('pheno_morphos', 'pheno_morphos.replacement_inventory_id', 'replacement_inventories.id')
        ->join('pheno_morpho_values', 'pheno_morpho_values.id', 'pheno_morphos.values_id')
        ->withTrashed()->get();
        dd($breeders);
    }

    public function getPhenoFamilySummary($generation)
    {
        $breeders = Generation::join('lines', 'lines.generation_id', 'generations.id')
        ->where('generations.id', $generation)
        ->join('families', 'families.line_id', 'lines.id')
        ->join('breeders', 'families.id', 'breeders.family_id')
        ->join('breeder_inventories', 'breeders.id', 'breeder_inventories.breeder_id')
        ->join('pheno_morphos', 'pheno_morphos.breeder_inventory_id', 'breeder_inventories.id')
        ->join('pheno_morpho_values', 'pheno_morpho_values.id', 'pheno_morphos.values_id')
        ->select('lines.number as line_number', 'families.number as family_number', 
                'pheno_morpho_values.phenotypic as pheno_values', 'pheno_morpho_values.morphometric as morpho_values',
                'pheno_morpho_values.gender as gender')
        ->withTrashed()->get();
        
        $replacements = Generation::join('lines', 'lines.generation_id', 'generations.id')
        ->where('generations.id', $generation)
        ->join('families', 'families.line_id', 'lines.id')
        ->join('replacements', 'families.id', 'replacements.family_id')
        ->join('replacement_inventories', 'replacements.id', 'replacement_inventories.replacement_id')
        ->join('pheno_morphos', 'pheno_morphos.replacement_inventory_id', 'replacement_inventories.id')
        ->join('pheno_morpho_values', 'pheno_morpho_values.id', 'pheno_morphos.values_id')
        ->select('lines.number as line_number', 'families.number as family_number', 
                'pheno_morpho_values.phenotypic as pheno_values', 'pheno_morpho_values.morphometric as morpho_values',
                'pheno_morpho_values.gender as gender')
        ->withTrashed()->get();

        $male = [];
        $female = [];
        
        foreach($breeders as $breeder) {
            if($breeder->gender == "male"){
                if(array_key_exists($breeder->family_number, $male)){
                    array_push($male[$breeder->family_number], json_decode($breeder->pheno_values, true));
                }else{
                    $male[$breeder->family_number] = array();
                    array_push($male[$breeder->family_number], json_decode($breeder->pheno_values, true));
                }
            }else{
                if(array_key_exists($breeder->family_number, $female)){
                    array_push($female[$breeder->family_number], json_decode($breeder->pheno_values, true));
                }else{
                    $female[$breeder->family_number] = array();
                    array_push($female[$breeder->family_number], json_decode($breeder->pheno_values, true));
                }
            }
        } 

        foreach($replacements as $replacement) {
            if($replacement->gender == "male"){
                if(array_key_exists($replacement->family_number, $male)){
                    array_push($male[$replacement->family_number], json_decode($replacement->pheno_values, true));
                }else{
                    $male[$replacement->family_number] = array();
                    array_push($male[$replacement->family_number], json_decode($replacement->pheno_values, true));
                }
            }else{
                if(array_key_exists($replacement->family_number, $female)){
                    array_push($female[$replacement->family_number], json_decode($replacement->pheno_values, true));
                }else{
                    $female[$replacement->family_number] = array();
                    array_push($female[$replacement->family_number], json_decode($replacement->pheno_values, true));
                }
            }
        }
        if(Auth::user()->getAnimalType() == 1){
            $props = [];
            $plumage_color = [];
            $plumage_pattern = [];
            $hackle_color = [];
            $hackle_pattern = [];
            $body_carriage = [];
            $comb_type = [];
            $comb_color = [];
            $earlobe_color = [];
            $iris_color = [];
            $beak_color = [];
            $shank_color = [];
            $skin_color = [];
            
            foreach($male as $member) {
                foreach ($member as $pheno) {
                    if(array_key_exists(ucfirst($pheno[0]) ,$plumage_color)){
                        $plumage_color[ucfirst($pheno[0])]++;
                    }else{
                        $plumage_color[ucfirst($pheno[0])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[1]) ,$plumage_pattern)){
                        $plumage_pattern[ucfirst($pheno[1])]++;
                    }else{
                        $plumage_pattern[ucfirst($pheno[1])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[2]) ,$hackle_color)){
                        $hackle_color[ucfirst($pheno[2])]++;
                    }else{
                        $hackle_color[ucfirst($pheno[2])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[3]) ,$hackle_pattern)){
                        $hackle_pattern[ucfirst($pheno[3])]++;
                    }else{
                        $hackle_pattern[ucfirst($pheno[3])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[4]) ,$body_carriage)){
                        $body_carriage[ucfirst($pheno[4])]++;
                    }else{
                        $body_carriage[ucfirst($pheno[4])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[5]) ,$comb_type)){
                        $comb_type[ucfirst($pheno[5])]++;
                    }else{
                        $comb_type[ucfirst($pheno[5])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[6]) ,$comb_color)){
                        $comb_color[ucfirst($pheno[6])]++;
                    }else{
                        $comb_color[ucfirst($pheno[6])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[7]) ,$earlobe_color)){
                        $earlobe_color[ucfirst($pheno[7])]++;
                    }else{
                        $earlobe_color[ucfirst($pheno[7])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[8]) ,$iris_color)){
                        $iris_color[ucfirst($pheno[8])]++;
                    }else{
                        $iris_color[ucfirst($pheno[8])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[9]) ,$beak_color)){
                        $beak_color[ucfirst($pheno[9])]++;
                    }else{
                        $beak_color[ucfirst($pheno[9])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[10]) ,$shank_color)){
                        $shank_color[ucfirst($pheno[10])]++;
                    }else{
                        $shank_color[ucfirst($pheno[10])] = 1;
                    }

                    if(array_key_exists(ucfirst($pheno[11]) ,$skin_color)){
                        $skin_color[ucfirst($pheno[11])]++;
                    }else{
                        $skin_color[ucfirst($pheno[11])] = 1;
                    }
                }                
            }
            array_push ($props, $plumage_color, $plumage_pattern, $hackle_color, $hackle_pattern, $body_carriage, $comb_type, $comb_color, $earlobe_color, $iris_color, $beak_color , $shank_color, $skin_color);
            
            dd($props);
        }else{
            $pheno = [];
            $plumage_color = [];
            $plumage_pattern = [];
            $body_carriage = [];
            $shank_color = [];
            $skin_color = [];
            $neck_markings = [];
            $wing_feather = [];
            $tail_feather = [];
            $bill_color = [];
            $bill_shape = [];
            $bean_color = [];
            $presence_crest = [];
            $eye_color = [];

        }
    }

    public function getMorphoFamilySummary()
    {
        
    }

    // public function getFarmSummary()
    // {
    //     $farm = Auth::user()->getFarm();
    //     $breed = Breed::where('id', $farm->breedable_id)->first();
    //     $gen_pheno = [];
    //     $gen_morpho = [];
    //     $mpheno = [];
    //     $fpheno = [];
    //     $mmorpho = [];
    //     $fmorpho = [];
    //     if($breed->animaltype_id == 1){
    //         $plumage_color = array("White" => 0, "Black" => 0, "Red" => 0, "Orange" => 0, "Brown" => 0, "Yellow" => 0);
    //         $plumage_pattern = array("Plain" => 0, "Barred" => 0, "Wild Type" => 0, "Laced" => 0, "Mottled" => 0);
    //         $hackle_color = array("Yellow" => 0, "Orange" => 0, "Brown" => 0, "Red" => 0, "Black" => 0);
    //         $hackle_pattern = array("Plain" => 0, "Laced" => 0, "Barred" => 0);
    //         $body_carriage = array("Slight Upright" => 0, "Upright" => 0,);
    //         $comb_type = array("Single" => 0, "Pea" => 0, "Rose" => 0,);
    //         $comb_color = array("Red" => 0, "Pink" => 0, "Black" => 0,);
    //         $earlobe_color = array("White" => 0, "Red" => 0, "Red-White" => 0,);
    //         $iris_color = array("Red" => 0, "Orange" => 0, "Brown" => 0, "Yellow" => 0,);
    //         $beak_color = array("White" => 0, "Black" => 0, "Brown" => 0, "Yellow" => 0,);
    //         $shank_color = array("White" => 0, "Black" => 0, "Yellow" => 0, "Green" => 0, "Grey" => 0,);
    //         $skin_color = array("White" => 0, "Yellow" => 0,);
    //         $height = array();
    //         $weight = array();
    //         $body_length = array();
    //         $chest_circumference = array();
    //         $wing_span = array();
    //         $shank_length = array();
    //     }else{
    //         $plumage_color = array("Black" => 0, "Black with Brown" => 0, "Brown" => 0, "Brown with Black" => 0);
    //         $plumage_pattern = array("Dusky" => 0, "Mallard" => 0, "Plain Brown" => 0, "Runner" => 0, "Runner/Mallard" => 0,);
    //         $body_carriage = array("Horizontal" => 0, "Slight Upright" => 0, "Upright" => 0,);
    //         $shank_color = array("Black" => 0, "Brown" => 0, "Dark Brown" => 0, "Dark Orange" => 0, "Orange with Black" => 0,);
    //         $skin_color = array("White" => 0);
    //         $neck_feather = array("Plain" => 0, "Bib-Small" => 0, "Bib-Medium" => 0, "Bib-Large" => 0);
    //         $wing_feather = array("Black" => 0, "Black with Brown" => 0, "Black with White" => 0, "Brown" => 0, "Brown with White" => 0);
    //         $tail_feather = array("Black" => 0, "Brown" => 0, "Brown with White" => 0);
    //         $bill_color = array("Green" => 0, "Black" => 0, "Black with Grey" => 0);
    //         $bill_shape = array("Uniform" => 0, "Saddle" => 0);
    //         $bean_color = array("Black" => 0, "Grey" => 0);
    //         $crest = array("Yes" => 0, "No" => 0);
    //         $eye_color = array("Black" => 0, "Brown" => 0);
    //         $height = array();
    //         $weight = array();
    //         $body_length = array();
    //         $chest_circumference = array();
    //         $wing_span = array();
    //         $shank_length = array();
    //         $bill_length = array();
    //         $neck_length = array();
    //     }
    //     $generations = Generation::where('farm_id', $farm->id)->where('is_active', true)->get();
    //     foreach($generations as $generation){
    //         $lines = $generation->getLines();
    //         foreach($lines as $line){
    //             $families = Family::where('line_id', $line->id)->where('is_active', true)->get();
    //             foreach($families as $family){
    //                 $breeders = Breeder::where('family_id', $family->id)->get();
    //                 foreach($breeders as $breeder){
    //                     $inventories = BreederInventory::where('breeder_id', $breeder->id)->get();
    //                     foreach($inventories as $inventory){

    //                     }
    //                 }
    //                 $replacements = Replacement::where('family_id', $family->id)->get();
    //                 foreach($replacements as $replacement){
    //                     $inventories = BreederInventory::where('replacement_id', $replacement->id)->get();
    //                     foreach($inventories as $inventory){

    //                     }
    //                 }
    //                 // $brooders = BrooderGrower::where('family_id', $family->id)->get();
    //                 // foreach($brooders as $brooder){
    //                 //     $inventories = BreederInventory::where('replacement_id', $brooder->id)->get();
    //                 //     $male = $male + $inventories->sum('number_male');
    //                 //     $female = $female + $inventories->sum('number_female');
    //                 //     $total = $total + $inventories->sum('total');
    //                 //     foreach($inventories as $inventory){
    //                 //         $brooder_feeding = $brooder_feeding + BrooderGrowerFeeding::where('broodergrower_inventory_id', $inventory->id)->whereBetween('date_collected', [$month_start, $month_end])->get()->sum('amount_offered');
    //                 //         $brooder_mortality = $brooder_mortality + MortalitySale::where('brooder_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'died')->get()->sum('total');
    //                 //         $brooder_sales = $brooder_sales + MortalitySale::where('brooder_inventory_id', $inventory->id)->whereBetween('date', [$month_start, $month_end])->where('category', 'sold')->where('type', 'brooder')->get()->sum('total');
    //                 //     }
    //                 // }
    //             }
    //         }
    //     }
    // }
}
