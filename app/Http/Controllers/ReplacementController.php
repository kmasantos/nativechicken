<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Auth;
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
use App\Models\ReplacementPhenoMorpho;
use App\Models\ReplacementPhenoMorphoValue;
use App\Models\ReplacementFeeding;

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

    /**
     * *PEN fetch all active replacement pens
     * TODO Display pen info
     */
    public function getReplacementPens()
    {
        $replacement_pens = Pen::where('farm_id', Auth::user()->farm_id)->where('type', 'grower')->orderBy('number', 'asc')->paginate(10);
        return $replacement_pens;
    }

    public function searchReplacementPens($search)
    {
        $replacement_pens = Pen::where('farm_id', Auth::user()->farm_id)
        ->where('number', 'like', '%'.$search.'%')
        ->where('type','grower')
        ->orderBy('number', 'asc')
        ->paginate(10);
        return $replacement_pens;
    }

    /**
     * ! Refactor fetching of replacement list to show pen
     * TODO Delete if needed
     */
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

    // public function addReplacements(Request $request)
    // {
    //     $request->validate([
    //         'family_id' => 'required',
    //         'date_added' => 'required',
    //         'number_male' => 'required',
    //         'number_female' => 'required',
    //         'pen_id' => 'required',
    //         'external' => 'required'
    //     ]);
    //     if($request->external){
    //         $new = new Replacement;
    //         $new->batching_date = null;
    //         $new->family_id = $request->family_id;
    //         $new->date_added = $request->date_added;
    //         $new->pen_id = $request->pen_id;

    //         $movement = new AnimalMovement;
    //         $movement->date = $request->date_added;
    //         $movement->family_id = $request->family_id;
    //         $movement->pen_id = $request->pen_id;
    //         $movement->type = "replacement";
    //         $movement->activity = "add replacement external";
    //         $movement->price = null;
    //         $movement->number_male = $request->number_male;
    //         $movement->number_female = $request->number_female;
    //         $movement->number_total = $movement->number_male + $movement->number_female;
    //         $movement->remarks = null;


    //         $family = Family::where('id', $request->family_id)->first();
    //         $family->replacement = true;


    //         $pen = Pen::where('id', $request->pen_id)->first();
    //         $pen->current_capacity = $pen->current_capacity + ($request->number_male + $request->number_female);

    //         $new->save();

    //         $inventory = new ReplacementInventory;
    //         $inventory->replacement_id = $new->id;
    //         $inventory->number_male = $request->number_male;
    //         $inventory->number_female = $request->number_female;
    //         $inventory->total = $inventory->number_male + $inventory->number_female;
    //         $inventory->last_update = $request->date_added;

    //         $inventory->save();
    //         $movement->save();
    //         $family->save();
    //         $pen->save();

    //         return response()->json(['status' => 'success', 'message' => 'Replacement added']);
    //     }else{
    //         $new = new Replacement;
    //         $new->batching_date = null;
    //         $new->family_id = $request->family_id;
    //         $new->date_added = $request->date_added;
    //         $new->pen_id = $request->pen_id;

    //         $movement = new AnimalMovement;
    //         $movement->date = $request->date_added;
    //         $movement->family_id = $request->family_id;
    //         $movement->pen_id = $request->pen_id;
    //         $movement->type = "replacement";
    //         $movement->activity = "add replacement internal";
    //         $movement->price = null;
    //         $movement->number_male = $request->number_male;
    //         $movement->number_female = $request->number_female;
    //         $movement->number_total = $movement->number_male + $movement->number_female;
    //         $movement->remarks = null;

    //         $family = Family::where('id', $request->family_id)->firstOrFail();
    //         $family->replacement = true;

    //         $pen = Pen::where('id', $request->pen_id)->firstOrFail();
    //         $pen->current_capacity = $pen->current_capacity + ($request->number_male + $request->number_female);

    //         // update affected brooder
    //         $brooderGrower = BrooderGrower::where('family_id', $request->family_id)->firstOrFail();
    //         $brooderGrowerInventory = BrooderGrowerInventory::where('broodergrower_id', $brooderGrower->id)->firstOrFail();
    //         $brooderGrowerInventory->number_male = $brooderGrowerInventory->number_male - $request->number_male;
    //         $brooderGrowerInventory->number_female = $brooderGrowerInventory->number_female - $request->number_female;
    //         $brooderGrowerInventory->total = $brooderGrowerInventory->number_male + $brooderGrowerInventory->number_female;
    //         $brooderGrowerInventory->last_update = $request->date_added;

    //         // update pen of brooder
    //         $brooderPen = Pen::where('id', $brooderGrower->pen_id)->firstOrFail();
    //         $brooderPen->current_capacity = $brooderPen->current_capacity + ($request->number_male + $request->number_female);

    //         // record the animal movement
    //         $brooderMovement = new AnimalMovement;
    //         $brooderMovement->date = $request->date_added;
    //         $brooderMovement->family_id = $brooderGrower->family_id;
    //         $brooderMovement->pen_id = $brooderGrower->pen_id;
    //         $brooderMovement->type = "broodersgrowers";
    //         $brooderMovement->activity = "move broodergrowers";
    //         $brooderMovement->price = null;
    //         $brooderMovement->number_male = $request->number_male;
    //         $brooderMovement->number_female = $request->number_female;
    //         $brooderMovement->number_total = $request->number_male + $request->number_female;
    //         $brooderMovement->remarks = null;

    //         $new->save();

    //         $inventory = new ReplacementInventory;
    //         $inventory->replacement_id = $new->id;
    //         $inventory->number_male = $request->number_male;
    //         $inventory->number_female = $request->number_female;
    //         $inventory->total = $inventory->number_male + $inventory->number_female;
    //         $inventory->last_update = $request->date_added;

    //         $inventory->save();
    //         $movement->save();
    //         $family->save();
    //         $pen->save();
    //         $brooderGrowerInventory->save();
    //         $brooderPen->save();
    //         $brooderMovement->save();
    //     }

    // }

    public function addReplacements(Request $request)
    {
        $date = Carbon::now();
        $request->validate([
            'family_id' => 'required',
            'date_added' => 'required',
            'batching_date' => 'required',
            'males' => 'required',
            'females' => 'required',
            'pen_id' => 'required',
            'external' => 'required'
        ]);
        $pen = Pen::where('id', $request->pen_id)->first();
        // check pen storage
        if($pen->total_capacity < ($pen->current_capacity+($request->males+$request->females))){
            return response()->json(['status' => 'error', 'message' => 'Storage insufficient']);
        }

        if($request->external){
            $replacement = Replacement::where('family_id', $request->family_id)->first();
            /**
             * * Replacement not yet in record
             */
            if($replacement == null){
                // new replacement instance
                $new = new Replacement;
                $new->family_id = $request->family_id;
                $new->batching_date = $request->batching_date;
                $new->date_added = $request->date_added;
                $new->save();
                // new inventory instance
                $inventory = new ReplacementInventory;
                $inventory->replacement_id = $new->id;
                $inventory->pen_id = $request->pen_id;
                $inventory->number_male = $request->males;
                $inventory->number_female = $request->females;
                $inventory->total = $request->males + $request->females;
                $inventory->last_update = $date->toDateString();
                $inventory->save();
                // update pen
                $pen->current_capacity = $pen->current_capacity+($request->males + $request->females);
                $pen->save();
                // update animal movements table
                $movement = new AnimalMovement;
                $movement->date = $request->date_added;
                $movement->family_id = $request->family_id;
                $movement->pen_id = $request->pen_id;
                $movement->type = "replacement";
                $movement->activity = "add replacement external";
                $movement->price = null;
                $movement->number_male = $request->males;
                $movement->number_female = $request->females;
                $movement->number_total = $request->males + $request->females;
                $movement->remarks = null;
                $movement->save();
                return response()->json(['status' => 'success', 'message' => 'Replacements added']);
            }else{
                // 2 cases, update existing and new inventory instance
                $inventory = ReplacementInventory::where('replacement_id', $replacement->id)->where('pen_id', $request->pen_id)->first();
                if($inventory == null){
                    $inventory = new ReplacementInventory;
                    $inventory->replacement_id = $replacement->id;
                    $inventory->pen_id = $request->pen_id;
                    $inventory->number_male = $request->males;
                    $inventory->number_female = $request->females;
                    $inventory->total = $request->males + $request->females;
                    $inventory->last_update = $date->toDateString();
                    $inventory->save();
                    // update pen
                    $pen->current_capacity = $pen->current_capacity+($request->males + $request->females);
                    $pen->save();
                    $movement = new AnimalMovement;
                    $movement->date = $request->date_added;
                    $movement->family_id = $request->family_id;
                    $movement->pen_id = $request->pen_id;
                    $movement->type = "replacement";
                    $movement->activity = "add replacement external";
                    $movement->price = null;
                    $movement->number_male = $request->males;
                    $movement->number_female = $request->females;
                    $movement->number_total = $request->males + $request->females;
                    $movement->remarks = null;
                    $movement->save();
                    return response()->json(['status' => 'success', 'message' => 'Replacements added']);
                }else{
                    $inventory->number_male = $inventory->number_male + $request->males;
                    $inventory->number_female = $inventory->number_female + $request->females;
                    $inventory->total = $inventory->total + ($request->males + $request->females);
                    $inventory->last_update = $date->toDateString();
                    $inventory->save();
                    $pen->current_capacity = $pen->current_capacity+($request->males + $request->females);
                    $pen->save();
                    $movement = new AnimalMovement;
                    $movement->date = $request->date_added;
                    $movement->family_id = $request->family_id;
                    $movement->pen_id = $request->pen_id;
                    $movement->type = "replacement";
                    $movement->activity = "add replacement external";
                    $movement->price = null;
                    $movement->number_male = $request->males;
                    $movement->number_female = $request->females;
                    $movement->number_total = $request->males + $request->females;
                    $movement->remarks = null;
                    $movement->save();
                    return response()->json(['status' => 'success', 'message' => 'Replacements added']);
                }
            }
        }else{
            // check brooder and grower for batching dates and correct number of input quantity
            $broodergrower = BrooderGrower::
            join('brooder_grower_inventories', 'brooder_growers.id', 'brooder_grower_inventories.broodergrower_id')
            ->select('brooder_growers.*', 'brooder_grower_inventories.*','brooder_grower_inventories.id as inventory_id')
            ->where('family_id', $request->family_id)
            ->whereDate('brooder_grower_inventories.batching_date','=', $request->batching_date)
            ->first();

            if($broodergrower==null){
                return response()->json(['status' => 'error', 'message' => 'No brooders and growers available']);
            }else{
                if($broodergrower->number_male < $request->males || $broodergrower->number_female < $request->females){
                    return response()->json(['status' => 'error', 'message' => 'Quantity does not match']);
                }
            }

            // update brooder and grower records
            $brooder_pen = Pen::where('id', $broodergrower->pen_id)->first();

            $brooder_inventory = BrooderGrowerInventory::where('id', $broodergrower->inventory_id)->first();
            $brooder_inventory->number_male = $brooder_inventory->number_male - $request->males;
            $brooder_inventory->number_female = $brooder_inventory->number_female - $request->females;
            $brooder_inventory->total = $brooder_inventory->total - ($request->males + $request->females);
            $brooder_inventory->last_update = $date->toDateString();
            $brooder_inventory->save();

            $brooder_pen->current_inventory = $brooder_pen->current_inventory + ($request->males + $request->females);
            $brooder_pen->save();

            $brooder_movement = new AnimalMovement;
            $brooder_movement->date = $request->date_added;
            $brooder_movement->family_id = $brooder_inventory->family_id;
            $brooder_movement->pen_id = $brooder_inventory->pen_id;
            $brooder_movement->type = "broodergrower";
            $brooder_movement->activity = "move broodergrower internal";
            $brooder_movement->price = null;
            $brooder_movement->number_male = $request->males;
            $brooder_movement->number_female = $request->females;
            $brooder_movement->number_total = $request->males + $request->females;
            $brooder_movement->remarks = null;
            $brooder_movement->save();

            $replacement = Replacement::where('family_id', $request->family_id)->first();
            if($replacement==null){
                $new = new Replacement;
                $new->family_id = $request->family_id;
                $new->batching_date = $request->batching_date;
                $new->date_added = $request->date_added;
                $new->save();
                // new inventory instance
                $inventory = new ReplacementInventory;
                $inventory->replacement_id = $new->id;
                $inventory->pen_id = $request->pen_id;
                $inventory->number_male = $request->males;
                $inventory->number_female = $request->females;
                $inventory->total = $request->males + $request->females;
                $inventory->last_update = $date->toDateString();
                $inventory->save();
                // update pen
                $pen->current_capacity = $pen->current_capacity+($request->males + $request->females);
                $pen->save();
                // update animal movements table
                $movement = new AnimalMovement;
                $movement->date = $request->date_added;
                $movement->family_id = $request->family_id;
                $movement->pen_id = $request->pen_id;
                $movement->type = "replacement";
                $movement->activity = "add replacement internal";
                $movement->price = null;
                $movement->number_male = $request->males;
                $movement->number_female = $request->females;
                $movement->number_total = $request->males + $request->females;
                $movement->remarks = null;
                $movement->save();
                return response()->json(['status' => 'success', 'message' => 'Replacements added']);
            }else{
                // 2 cases, update existing and new inventory instance
                $inventory = ReplacementInventory::where('replacement_id', $replacement->id)->where('pen_id', $request->pen_id)->first();
                if($inventory == null){
                    $inventory = new ReplacementInventory;
                    $inventory->replacement_id = $replacement->id;
                    $inventory->pen_id = $request->pen_id;
                    $inventory->number_male = $request->males;
                    $inventory->number_female = $request->females;
                    $inventory->total = $request->males + $request->females;
                    $inventory->last_update = $date->toDateString();
                    $inventory->save();
                    // update pen
                    $pen->current_capacity = $pen->current_capacity+($request->males + $request->females);
                    $pen->save();
                    $movement = new AnimalMovement;
                    $movement->date = $request->date_added;
                    $movement->family_id = $request->family_id;
                    $movement->pen_id = $request->pen_id;
                    $movement->type = "replacement";
                    $movement->activity = "add replacement internal";
                    $movement->price = null;
                    $movement->number_male = $request->males;
                    $movement->number_female = $request->females;
                    $movement->number_total = $request->males + $request->females;
                    $movement->remarks = null;
                    $movement->save();
                    return response()->json(['status' => 'success', 'message' => 'Replacements added']);
                }else{
                    $inventory->number_male = $inventory->number_male + $request->males;
                    $inventory->number_female = $inventory->number_female + $request->females;
                    $inventory->total = $inventory->total + ($request->males + $request->females);
                    $inventory->last_update = $date->toDateString();
                    $inventory->save();
                    $pen->current_capacity = $pen->current_capacity+($request->males + $request->females);
                    $pen->save();
                    $movement = new AnimalMovement;
                    $movement->date = $request->date_added;
                    $movement->family_id = $request->family_id;
                    $movement->pen_id = $request->pen_id;
                    $movement->type = "replacement";
                    $movement->activity = "add replacement internal";
                    $movement->price = null;
                    $movement->number_male = $request->males;
                    $movement->number_female = $request->females;
                    $movement->number_total = $request->males + $request->females;
                    $movement->remarks = null;
                    $movement->save();
                    return response()->json(['status' => 'success', 'message' => 'Replacements added']);
                }
            }
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

    public function fetchPenInfo ($pen_id)
    {
        $replacements = ReplacementInventory::where('pen_id', $pen_id)
        ->join('replacements', 'replacement_inventories.replacement_id', 'replacements.id')
        ->join('families', 'replacements.family_id', 'families.id')
        ->join('lines', 'families.line_id', 'lines.id')
        ->select('replacement_inventories.*', 'replacements.*', 'families.number as fam_number', 'lines.number as line_number',
        'families.id as fam_id', 'replacements.id as rep_id', 'replacement_inventories.id as inv_id')
        ->get();

        return $replacements;
    }

    public function phenoMorphoPage($replacement_id)
    {
        return view('chicken.replacement.phenomorpho_record', compact('replacement_id'));
    }

    public function addPhenoMorpho(Request $request)
    {
        $date = Carbon::now();
        $request->validate([
            'replacement_id' => 'required',
            'gender' => 'required',
            'plummage_color' => 'required',
            'plummage_pattern' => 'required',
            'hackle_color' => 'required',
            'hackle_pattern' => 'required',
            'body_carriage' => 'required',
            'comb_type' => 'required',
            'comb_color' => 'required',
            'earlobe_color' => 'required',
            'iris_color' => 'required',
            'beak_color' => 'required',
            'shank_color' => 'required',
            'skin_color' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'body_length' => 'required',
            'chest_circumference' => 'required',
            'wing_span' => 'required',
            'shank_length' => 'required',
        ]);

        $pheno = collect([
            $request->plummage_color,
            $request->plummage_pattern,
            $request->hackle_color,
            $request->hackle_pattern,
            $request->body_carriage,
            $request->comb_type,
            $request->comb_color,
            $request->earlobe_color,
            $request->iris_color,
            $request->beak_color,
            $request->shank_color,
            $request->skin_color
        ]);

        $morpho = collect([
            $request->height,
            $request->weight,
            $request->body_length,
            $request->chest_circumference,
            $request->wing_span,
            $request->shank_length
        ]);

        $phenomorphovalues = new ReplacementPhenoMorphoValue;
        $phenomorphovalues->gender = $request->gender;
        $phenomorphovalues->phenotypic = $pheno;
        $phenomorphovalues->morphometric = $morpho;
        $phenomorphovalues->date_collected = $date->toDateString();
        $phenomorphovalues->save();

        $phenomorpho = new ReplacementPhenoMorpho;
        $phenomorpho->replacement_id = $request->replacement_id;
        $phenomorpho->values_id = $phenomorphovalues->id;
        $phenomorpho->save();
        return response()->json(['status' => 'success', 'message' => 'Phenotypic and Morphometric values saved']);
    }

    public function addPenFeedingRecord (Request $request)
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

        $inventories = ReplacementInventory::where('pen_id', $request->pen_id)->get();
        foreach ($inventories as $inventory) {
            $feeding = new ReplacementFeeding;
            $feeding->replacement_id = $inventory->replacement_id;
            $feeding->pen_id = $inventory->pen_id;
            $feeding->date_collected = $request->date_collected;
            $feeding->amount_offered = round($inventory->total*$feed_offered_per_head, 3);
            $feeding->amount_refused = round($inventory->total*$feed_refused_per_head, 3);
            $feeding->remarks = $request->remarks;
            $feeding->save();
        }
        return response()->json(['status' => 'success', 'message' => 'Feeding record saved']);
    }

    public function feedingRecordPage()
    {
        return view('chicken.replacement.feeding_record');
    }

    /*
    **  Helper Functions
    */
    public function fetchGenerations ()
    {
        $generations = Generation::where('farm_id', Auth::user()->farm_id)->where('is_active', true)->orderBy('numerical_generation', 'asc')->get();
        return $generations;
    }
    public function fetchLines ($generation_id)
    {
        $lines = Line::where('is_active', true)->where('generation_id', $generation_id)->orderBy('number', 'asc')->get();
        return $lines;
    }
    public function fetchFamilies ($line_id)
    {
        $families = Family::where('is_active', true)->where('line_id', $line_id)->orderBy('number', 'asc')->get();
        return $families;
    }

}
