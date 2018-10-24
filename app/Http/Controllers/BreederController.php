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

    public function getBreederList()
    {
        $breeders = Breeder::join('families', 'families.id', 'breeders.family_id')
                    ->join('lines', 'lines.id', 'families.line_id')
                    ->join('generations', 'generations.id', 'lines.generation_id')
                    ->select('breeders.*', 'families.number as family_number',
                    'lines.number as line_number', 'generations.number as generation_number')
                    ->paginate(8);
        return $breeders;
    }

    public function addBreeder(Request $request)
    {
        if($request->external == false){
            $request->validate([
                'family_id' => 'required',
                'selected_female_family' => 'required',
                'date_added' => 'required',
                'number_male' => 'required',
                'number_female' => 'required',
                'pen_id' => 'required'
            ]);
            // create new breeder instance
            $new = new Breeder;
            $new->family_id = $request->family_id;
            $new->female_family_id = null;
            $new->date_added = $request->date_added;
            $new->pen_id = $request->pen_id;
            $new->save();

            // create breeder's inventory instance
            $inventory = new BreederInventory;
            $inventory->breeder_id = $new->id;
            $inventory->date_removed = $request->selected_female_family;
            $inventory->number_male = $request->number_male;
            $inventory->number_female = $request->number->female;
            $inventory->total = $inventory->number_male + $inventory->number_female;
            $inventory->last_update = $request->date_added;
            $inventory->save();

            // @TODO check
            // create log in animal movement for the new breeder
            $newAnimalMovement = new AnimalMovement;
            $newAnimalMovement->date = $request->date_added;
            $newAnimalMovement->family_id = $request->family_id;
            $newAnimalMovement->pen_id = $request->pen_id;
            $newAnimalMovement->type = 'breeder';
            $newAnimalMovement->activity = 'add breeder internal';
            $newAnimalMovement->price = null;
            $newAnimalMovement->number_male = $request->number_male;
            $newAnimalMovement->number_female = $request->number_female;
            $newAnimalMovement->number_total = $request->number_male + $request->number_female;
            $newAnimalMovement->remarks = null;
            $newAnimalMovement->save();

            // @TODO change model of all inventories to one to one relationship
            // @TODO update the animal movements table to track all movements
            // @TODO NOTE DO THIS FOR ALL ADD AND UPDATES IN BREEDERS, REPLACEMENTS, BROODERS&GROWERS
            $maleReplacement = Replacement::where('family_id', $request->family_id)->firstOrFail();
            $femaleReplacement = Replacement::where('family_id', $request->selected_female_family)->firstOrFail();
            // update male replacement inventory
            $replacementInventoryMale = ReplacementInventory::where('replacement_id', $maleReplacement->id)->firstOrFail();
            $replacementInventoryMale->number_male = $replacementInventoryMale->number_male - $request->number_male;
            $replacementInventoryMale->total = $replacementInventoryMale->total - $request->number_male;
            $replacementInventoryMale->last_update = $request->date_added;
            $replacementInventoryMale->save();

            // @TODO check
            // create record in animal movement for the replacement male
            $newAnimalMovementReplacementMale = new AnimalMovement;
            $newAnimalMovementReplacementMale->date = $request->date_added;
            $newAnimalMovementReplacementMale->family_id = $maleReplacement->family_id;
            $newAnimalMovementReplacementMale->pen_id = $maleReplacement->pen_id;
            $newAnimalMovementReplacementMale->type = 'replacement';
            $newAnimalMovementReplacementMale->activity = 'move replacement';
            $newAnimalMovementReplacementMale->price = null;
            $newAnimalMovementReplacementMale->number_male = $request->number_male;
            $newAnimalMovementReplacementMale->number_female = 0;
            $newAnimalMovementReplacementMale->number_total = $request->number_male;
            $newAnimalMovementReplacementMale->remarks = null;
            $newAnimalMovementReplacementMale->save();

            // update female replacement inventory
            $replacementInventoryFemale = ReplacementInventory::where('replacement_id', $femaleReplacement->id)->firstOrFail();
            $replacementInventoryFemale->number_female = $replacementInventoryFemale->number_female - $request->number_female;
            $replacementInventoryFemale->total = $replacementInventoryFemale->total - $request->number_female;
            $replacementInventoryFemale->last_update = $request->date_added;
            $replacementInventoryFemale->save();

            // @TODO check
            // create record in animal movement for the replacement female
            $newAnimalMovementReplacementFemale = new AnimalMovement;
            $newAnimalMovementReplacementFemale->date = $request->date_added;
            $newAnimalMovementReplacementFemale->family_id = $femaleReplacement->family_id;
            $newAnimalMovementReplacementFemale->pen_id = $femaleReplacement->pen_id;
            $newAnimalMovementReplacementFemale->type = 'replacement';
            $newAnimalMovementReplacementFemale->activity = 'move replacement';
            $newAnimalMovementReplacementFemale->price = null;
            $newAnimalMovementReplacementFemale->number_male = 0;
            $newAnimalMovementReplacementFemale->number_female = $request->number_female;
            $newAnimalMovementReplacementFemale->number_total = $request->number_female;
            $newAnimalMovementReplacementFemale->remarks = null;
            $newAnimalMovementReplacementFemale->save();

            // update male replacement pen
            $replacementPenMale = Pen::where('id', $maleReplacement->pen_id)->firstOrFail();
            $replacementPenMale->current_capacity = $replacementPenMale->current_capacity - $request->number_male;
            $replacementPenMale->save();

            // update female replacement pen
            $replacementPenFemale = Pen::where('id', $femaleReplacement->pen_id)->firstOrFail();;
            $replacementPenFemale->current_capacity = $replacementPenFemale->current_capacity - $request->number_female;
            $replacementPenFemale->save();

            // update pen where breeder is assigned
            $pen = Pen::where('id', $request->pen_id)->firstOrFail();
            $pen->current_capacity = $inventory->total;
            $pen->save();

            // update family breeder trigger to true
            $family = Family::where('id', $request->family_id)->firstOrFail();
            $family->breeder = true;
            $family->save();
            return response()->json(['status' => 'success', 'message' => 'Breeders added']);
        }else{
            $request->validate([
                'family_id' => 'required',
                'date_added' => 'required',
                'number_male' => 'required',
                'number_female' => 'required',
                'pen_id' => 'required'
            ]);
            // create new breeder instance
            $new = new Breeder;
            $new->family_id = $request->family_id;
            $new->female_family_id = null;
            $new->date_added = $request->date_added;
            $new->pen_id = $request->pen_id;
            $new->save();
            // create breeder's inventory instance
            $inventory = new BreederInventory;
            $inventory->breeder_id = $new->id;
            $inventory->date_removed = null;
            $inventory->number_male = $request->number_male;
            $inventory->number_female = $request->number_female;
            $inventory->total = $inventory->number_male + $inventory->number_female;
            $inventory->last_update = $request->date_added;
            $inventory->save();
            // update pen where breeder is assigned
            $pen = Pen::where('id', $request->pen_id)->firstOrFail();
            $pen->current_capacity = $inventory->total;
            $pen->save();
            // update family breeder trigger to true
            $family = Family::where('id', $request->family_id)->firstOrFail();
            $family->breeder = true;
            $family->save();
            // create animal movement instance
            $movement = new AnimalMovement;
            $movement->date = $request->date_added;
            $movement->family_id = $request->family_id;
            $movement->pen_id = $pen->id;
            $movement->type = "breeder";
            $movement->activity = "add breeder external";
            $movement->price = null;
            $movement->number_male = $request->number_male;
            $movement->number_female = $request->number_female;
            $movement->number_total = $request->number_male + $request->number_female;
            $movement->remarks = null;
            $movement->save();
            return response()->json(['status' => 'success', 'message' => 'Breeders added']);
        }

        // return response()->json(['status' => 'success', 'message' => 'Breeders added']);
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
    public function addHatcheryParameter(Request $request)
    {
        $request->validate([
            'breeder_id' => 'required',
            'date_eggs_set' => 'required',
            'batching_date' => 'required',
            'number_eggs_set' => 'required',
            'week_of_lay' => 'required',
            'number_fertile' => 'required',
            'number_hatched' => 'required',
            'date_hatched' => 'required'
        ]);

        $hatchery = new HatcheryRecord;
        $hatchery->breeder_id = $request->breeder_id;
        $hatchery->date_eggs_set = $request->date_eggs_set;
        $hatchery->batching_date = $request->date_eggs_set;
        $hatchery->number_eggs_set = $request->date_eggs_set;
        $hatchery->week_of_lay = $request->date_eggs_set;
        $hatchery->number_fertile = $request->date_eggs_set;
        $hatchery->number_hatched = $request->date_eggs_set;
        $hatchery->date_hatched = $request->date_eggs_set;
        $hatchery->save();
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
        if($generation_id == ""){
            $lines = Line::where('is_active', true)->get();
            return $lines;
        }else{
            $lines = Line::where('is_active', true)->where('generation_id', $generation_id)->get();
            return $lines;
        }

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
        $pens = Pen::where('farm_id', Auth::user()->farm_id)->where('is_active', true)->where('type', 'layer')->get();
        return $pens;
    }
}
