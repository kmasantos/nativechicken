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
use App\Models\PhenoMorpho;
use App\Models\PhenoMorphoValue;
use App\Models\ReplacementFeeding;
use App\Models\ReplacementGrowth;
use App\Models\MortalitySale;

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
        $family = Family::where('id', $request->family_id)->firstOrFail();
        $line = Line::where('id', $family->line_id)->firstOrFail();
        $generation = Generation::where('id', $line->generation_id)->firstOrFail();

        $code = Auth::user()->getFarm()->code;
        $timestamp = Carbon::now()->timestamp;
        $tag = $code.$generation->number.$line->number.$family->number.$timestamp;

        $request->validate([
            "family_id" => "required",
            "pen_id" => "required",
            "total" => "required",
            "external" => "required",
        ]);
        $replacement_pen = Pen::where('id', $request->pen_id)->firstOrFail();
        $replacement = Replacement::where('family_id', $request->family_id)->first();
        if($replacement_pen->total_capacity < ($replacement_pen->current_capacity + $request->total)){
            return response()->json( ['status' => 'error', 'message' => 'Total quantity too large for replacement pen'] );
        }
        if($replacement == null){
            $replacement = new Replacement;
            $replacement->family_id = $request->family_id;
            $replacement->date_added = $request->date_added;
            $replacement->save();
        }

        if($request->external){
            $replacement_pen->current_capacity = $replacement_pen->current_capacity + $request->total;
            $replacement_pen->save();

            $movement = new AnimalMovement;
            $movement->date = $request->date_added;
            $movement->family_id = $request->family_id;
            $movement->tag = $tag;
            $movement->previous_pen_id = null;
            $movement->current_pen_id = $replacement_pen->id;
            $movement->previous_type = null;
            $movement->current_type = "replacement";
            $movement->activity = "transfer";
            $movement->number_total = $request->total;
            $movement->remarks = "outside system";
            $movement->save();

            $inventory = new ReplacementInventory;
            $inventory->replacement_id = $replacement->id;
            $inventory->pen_id = $replacement_pen->id;
            $inventory->replacement_tag = $tag;
            $inventory->batching_date = $request->estimate_hatch_date;
            $inventory->total = $request->total;
            $inventory->last_update = $request->date_added;
            $inventory->save();
            return response()->json(['status' => 'success', 'message' => 'Replacement added']);
        }else{
            $brooder_inventory = BrooderGrowerInventory::where('id', $request->brooder_inventory)->first();
            if($brooder_inventory->total < $request->total){
                return response()->json( ['status' => 'error', 'message' => 'Total quantity too large for brooder inventory selected'] );
            }

            $brooder_movement = new AnimalMovement;
            $brooder_movement->date = $request->date_added;
            $brooder_movement->family_id = $request->family_id;
            $brooder_movement->tag = $tag;
            $brooder_movement->previous_pen_id = $brooder_inventory->pen_id;
            $brooder_movement->current_pen_id = $replacement_pen->id;
            $brooder_movement->previous_type = "broodersgrowers";
            $brooder_movement->current_type = "replacement";
            $brooder_movement->activity = "transfer";
            $brooder_movement->number_total = $request->total;
            $brooder_movement->remarks = "within system";
            $brooder_movement->save();

            $brooder_pen = Pen::where('id', $brooder_inventory->pen_id)->firstOrFail();
            $brooder_pen->current_capacity = $brooder_pen->current_capacity - $request->total;
            $brooder_pen->save();

            $replacement_pen->current_capacity = $replacement_pen->current_capacity + $request->total;
            $replacement_pen->save();

            $inventory = new ReplacementInventory;
            $inventory->replacement_id = $replacement->id;
            $inventory->pen_id = $replacement_pen->id;
            $inventory->replacement_tag = $tag;
            $inventory->batching_date = $brooder_inventory->batching_date;
            $inventory->total = $request->total;
            $inventory->last_update = $request->date_added;
            $inventory->save();

            if(($brooder_inventory->total - $request->total) === 0){
                $brooder_inventory->delete();
            }else{
                $brooder_inventory->total = $brooder_inventory->total - $request->total;
                $brooder_inventory->save();
            }

            return response()->json(['status' => 'success', 'message' => 'Replacement added']);
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
        ->leftJoin('replacements', 'replacement_inventories.replacement_id', 'replacements.id')
        ->leftJoin('families', 'replacements.family_id', 'families.id')
        ->leftJoin('lines', 'families.line_id', 'lines.id')
        ->leftJoin('generations', 'generations.id', 'lines.generation_id')
        ->select('replacement_inventories.*', 'replacements.*', 'families.number as fam_number', 'lines.number as line_number',
        'families.id as fam_id', 'replacements.id as rep_id', 'replacement_inventories.id as inv_id', 'generations.number as gen_number')
        ->orderBy('replacement_inventories.last_update', 'asc')
        ->paginate(10);

        return $replacements;
    }

    /**
     * TODO Check if all male and all have pheno and morpho data
     */
    public function addPhenoMorpho(Request $request)
    {
        if($request->duck){
            $request->validate([
                'replacement_inventory_id' => 'required',
                'tag' => 'required',
                'date_collected' => 'required',
                'gender' => 'required',
                'plummage_color' => 'required',
                'plummage_pattern' => 'required',
                'neck_feather' => 'required',
                'wing_feather' => 'required',
                'tail_feather' => 'required',
                'bill_color' => 'required',
                'bill_shape' => 'required',
                'bean_color' => 'required',
                'crest' => 'required',
                'eye_color' => 'required',
                'body_carriage' => 'required',
                'shank_color' => 'required',
                'skin_color' => 'required',
                'height' => 'required',
                'weight' => 'required',
                'body_length' => 'required',
                'chest_circumference' => 'required',
                'wing_span' => 'required',
                'shank_length' => 'required',
                'bill_length'  => 'required',
                'neck_length'  => 'required',
            ]);

            $pheno = collect([
                $request->plummage_color,
                $request->plummage_pattern,
                $request->neck_feather,
                $request->wing_feather,
                $request->tail_feather,
                $request->bill_color,
                $request->bill_shape,
                $request->bean_color,
                $request->crest,
                $request->eye_color,
                $request->body_carriage,
                $request->shank_color,
                $request->skin_color
            ]);
            $morpho = collect([
                $request->height,
                $request->weight,
                $request->body_length,
                $request->chest_circumference,
                $request->wing_span,
                $request->shank_length,
                $request->bill_length,
                $request->neck_length
            ]);
        }else{
            $request->validate([
                'replacement_inventory_id' => 'required',
                'tag' => 'required',
                'date_collected' => 'required',
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
                'shank_length' => 'required'
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
        }

        $phenomorphovalues = new PhenoMorphoValue;
        $phenomorphovalues->tag = $request->tag;
        $phenomorphovalues->gender = $request->gender;
        $phenomorphovalues->phenotypic = $pheno;
        $phenomorphovalues->morphometric = $morpho;
        $phenomorphovalues->date_collected = $request->date_collected;
        $phenomorphovalues->save();

        $phenomorpho = new PhenoMorpho;
        $phenomorpho->replacement_inventory_id = $request->replacement_inventory_id;
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
            $feeding->replacement_inventory_id  = $inventory->id;
            $feeding->date_collected = $request->date_collected;
            $feeding->amount_offered = round($inventory->total*$feed_offered_per_head, 3);
            $feeding->amount_refused = round($inventory->total*$feed_refused_per_head, 3);
            $feeding->remarks = $request->remarks;
            $feeding->save();
        }
        return response()->json(['status' => 'success', 'message' => 'Feeding record saved']);
    }

    public function fetchFeedingRecords($pen_id)
    {
        $feedingrecords = ReplacementFeeding::
            leftJoin('replacement_inventories', 'replacement_feedings.replacement_inventory_id', 'replacement_inventories.id')
            ->select('replacement_feedings.*', 'replacement_inventories.*', 'replacement_inventories.id as inventory_id', 'replacement_feedings.id as feeding_id')
            ->where('replacement_inventories.pen_id', $pen_id)
            ->orderBy('replacement_feedings.date_collected', 'desc')
            ->paginate(10);
        return $feedingrecords;
    }

    public function selectFeedingRecords ($record)
    {
        $selected = ReplacementFeeding::where('id', $record)->firstOrFail();
        $selected_inventory = ReplacementInventory::where('id', $selected->replacement_inventory_id)->firstOrFail();
        $selected_pen = Pen::where('id', $selected_inventory->pen_id)->firstOrFail();

        $selected_records = ReplacementFeeding::where('replacement_feedings.date_collected', $selected->date_collected)
                            ->leftJoin('replacement_inventories', 'replacement_inventories.id', 'replacement_feedings.replacement_inventory_id')
                            ->where('replacement_inventories.pen_id', $selected_inventory->pen_id)
                            ->select('replacement_feedings.*', 'replacement_inventories.*',
                                    'replacement_inventories.id as inventory_id', 'replacement_feedings.id as record_id')
                            ->paginate(10);
        return $selected_records;
    }

    public function deleteFeedingRecord ($record)
    {
        $selected = ReplacementFeeding::where('id', $record)->firstOrFail();
        $selected_inventory = ReplacementInventory::where('id', $selected->replacement_inventory_id)->firstOrFail();
        $selected_pen = Pen::where('id', $selected_inventory->pen_id)->firstOrFail();

        $selected_records = ReplacementFeeding::where('replacement_feedings.date_collected', $selected->date_collected)
                            ->leftJoin('replacement_inventories', 'replacement_inventories.id', 'replacement_feedings.replacement_inventory_id')
                            ->where('replacement_inventories.pen_id', $selected_inventory->pen_id)
                            ->select('replacement_feedings.*', 'replacement_inventories.*',
                                    'replacement_inventories.id as inventory_id', 'replacement_feedings.id as record_id')
                            ->get();

        foreach ($selected_records as $selected_record) {
            $delete = ReplacementFeeding::where('id', $selected_record->record_id)->firstOrFail();
            $delete->forceDelete();
        }
        return response()->json(['status' => 'success', 'message' => 'Feeding records deleted']);
    }

    public function fetchGrowthRecord ($pen_id)
    {
        $growthrecords = ReplacementGrowth::
        leftJoin('replacement_inventories', 'replacement_inventories.id', '=','replacement_growths.replacement_inventory_id')
        ->where('replacement_inventories.pen_id', $pen_id)
        ->select('replacement_growths.*', 'replacement_inventories.replacement_tag as replacement_tag', 'replacement_inventories.pen_id as pen_id',
        'replacement_inventories.replacement_id as replacement_id','replacement_growths.id as growth_id')
        ->orderBy('date_collected', 'desc')
        ->paginate(10);
        return $growthrecords;
    }

    public function addGrowthRecord (Request $request)
    {
        try{
            if($request->sexing){
                $request->validate([
                    'pen_id' => 'required',
                    'collection_day' => 'required',
                    'date_collected' => 'required',
                    'male_weight' => 'required',
                    'female_weight' => 'required',
                ]);

                $pen = Pen::where('id', $request->pen_id)->first();
                $inventories = ReplacementInventory::where('pen_id', $request->pen_id)->get();
                $total_female = $inventories->sum('number_female');
                $weight_per_female = $request->female_weight/$total_female;
                $total_male = $inventories->sum('number_male');
                $weight_per_male = $request->male_weight/$total_male;
                foreach ($inventories as $inventory) {
                    $check_record = ReplacementGrowth::where('replacement_inventory_id', $inventory->id)->where('collection_day', $request->collection_day)->first();
                    if($check_record == null){
                        $growth_record = new ReplacementGrowth;
                        $growth_record->replacement_inventory_id = $inventory->id;
                        $growth_record->date_collected = $request->date_collected;
                        $growth_record->collection_day = $request->collection_day;
                        $growth_record->male_quantity = $inventory->number_male;
                        $growth_record->male_weight = round($inventory->number_male*$weight_per_male, 3);
                        $growth_record->female_quantity = $inventory->number_female;
                        $growth_record->female_weight = round($inventory->number_female*$weight_per_female, 3);
                        $growth_record->total_quantity = $inventory->total;
                        $growth_record->total_weight = $growth_record->male_weight+$growth_record->female_weight;
                        $growth_record->save();
                    }
                }
    
                return response()->json(['status' => 'success', 'message' => 'Growth record saved']);

            }else{
                $request->validate([
                    'pen_id' => 'required',
                    'collection_day' => 'required',
                    'date_collected' => 'required',
                    'total_weight' => 'required',
                ]);
            }
            
            $pen = Pen::where('id', $request->pen_id)->first();
            $inventories = ReplacementInventory::where('pen_id', $request->pen_id)->get();
            $total = $inventories->sum('total');
            $weight_per_head = $request->total_weight/$total;
            foreach ($inventories as $inventory) {
                $check_record = ReplacementGrowth::where('replacement_inventory_id', $inventory->id)->where('collection_day', $request->collection_day)->first();
                if($check_record == null){
                    $growth_record = new ReplacementGrowth;
                    $growth_record->replacement_inventory_id = $inventory->id;
                    $growth_record->date_collected = $request->date_collected;
                    $growth_record->collection_day = $request->collection_day;
                    $growth_record->total_quantity = $inventory->total;
                    $growth_record->total_weight = round($inventory->total*$weight_per_head, 3);
                    $growth_record->save();
                }
            }

            return response()->json(['status' => 'success', 'message' => 'Growth record saved']);


        }catch (Exception $e){
            return response()->json(['status' => 'error', 'message' => $e]);
        }
    }

    public function selectGrowthRecords ($record)
    {
        $selected = ReplacementGrowth::where('id', $record)->firstOrFail();
        $selected_inventory = ReplacementInventory::where('id', $selected->replacement_inventory_id)->firstOrFail();
        $selected_pen = Pen::where('id', $selected_inventory->pen_id)->firstOrFail();

        $selected_records = ReplacementGrowth::where('replacement_growths.date_collected', $selected->date_collected)
                            ->where('replacement_growths.collection_day', $selected->collection_day)
                            ->leftJoin('replacement_inventories', 'replacement_inventories.id', 'replacement_growths.replacement_inventory_id')
                            ->where('replacement_inventories.pen_id', $selected_inventory->pen_id)
                            ->select('replacement_growths.*', 'replacement_inventories.*',
                                    'replacement_inventories.id as sel_inventory_id', 'replacement_growths.id as sel_growth_id')
                            ->paginate(10);
        return $selected_records;
    }

    public function deleteGrowthRecord ($record)
    {
        $selected = ReplacementGrowth::where('id', $record)->firstOrFail();
        $selected_inventory = ReplacementInventory::where('id', $selected->replacement_inventory_id)->firstOrFail();
        $selected_pen = Pen::where('id', $selected_inventory->pen_id)->firstOrFail();

        $selected_records = ReplacementGrowth::where('replacement_growths.date_collected', $selected->date_collected)
                            ->where('replacement_growths.collection_day', $selected->collection_day)
                            ->leftJoin('replacement_inventories', 'replacement_inventories.id', 'replacement_growths.replacement_inventory_id')
                            ->where('replacement_inventories.pen_id', $selected_inventory->pen_id)
                            ->select('replacement_growths.*', 'replacement_inventories.*',
                                    'replacement_inventories.id as sel_inventory_id', 'replacement_growths.id as sel_growth_id')
                            ->get();

        foreach ($selected_records as $record) {
            $delete = ReplacementGrowth::where('id', $record->sel_growth_id)->firstOrFail();
            $delete->forceDelete();
        }
        return response()->json(['status' => 'success', 'message' => 'Growth record deleted']);
    }

    public function getPhenoMorphoInventory($pen_id)
    {
        $replacements = ReplacementInventory::where('pen_id', $pen_id)
        ->leftJoin('replacements', 'replacement_inventories.replacement_id', 'replacements.id')
        ->leftJoin('families', 'replacements.family_id', 'families.id')
        ->select('replacement_inventories.*', 'replacements.*', 'families.number as fam_number',
        'families.id as fam_id', 'replacements.id as rep_id', 'replacement_inventories.id as inv_id')
        ->orderBy('replacement_inventories.last_update', 'asc')
        ->paginate(10);
        return $replacements;
    }

    public function getPhenoMorphoList($inventory_id)
    {
        $list = PhenoMorpho::
        leftjoin('pheno_morpho_values', 'pheno_morphos.values_id', 'pheno_morpho_values.id')
        ->select('pheno_morphos.id as pheno_morpho_id', 'pheno_morpho_values.id as values_id', 'pheno_morphos.replacement_inventory_id',
        'pheno_morpho_values.gender', 'pheno_morpho_values.tag', 'pheno_morpho_values.phenotypic',
        'pheno_morpho_values.morphometric', 'pheno_morpho_values.date_collected')
        ->where('pheno_morphos.replacement_inventory_id', $inventory_id)
        ->paginate(10);
        return $list;
    }

    public function deletePhenoMorphoRecord ($record)
    {
        $pheno_morpho_value = PhenoMorphoValue::where('id', $record)->firstOrFail();
        $pheno_morpho = PhenoMorpho::where('values_id', $pheno_morpho_value->id)->firstOrFail();
        $pheno_morpho->forceDelete();
        $pheno_morpho_value->forceDelete();
        return response()->json(['status' => 'success', 'message' => 'Pheno & Morpho record deleted']);
    }

    public function getMortalitySale ($inventory_id)
    {
        $record = MortalitySale::where('replacement_inventory_id', $inventory_id)
        ->orderBy('date', 'desc')
        ->paginate(10);
        return $record;
    }

    public function addMortality (Request $request)
    {
        $replacement_inventory = ReplacementInventory::where('id', $request->replacement_id)->firstOrFail();
        if($request->male > $replacement_inventory->number_male || $request->female > $replacement_inventory->number_female){
            return response()->json( ['error'=>'Input too quantity is too large for the inventory'] );
        }

        $replacement_pen = Pen::where('id', $replacement_inventory->pen_id)->firstOrFail();
        $replacement_inventory->number_male = $replacement_inventory->number_male - $request->male;
        $replacement_inventory->number_female = $replacement_inventory->number_female - $request->female;
        $replacement_inventory->total = $replacement_inventory->total - ($request->male + $request->female);

        $replacement_pen->current_capacity = $replacement_pen->current_capacity - ($request->male + $request->female);

        $movement = new AnimalMovement;
        $movement->date = $request->date;
        $movement->family_id = $replacement_inventory->getReplacementData()->family_id;
        $movement->tag = $replacement_inventory->tag;
        $movement->previous_pen_id = $replacement_pen->id;
        $movement->current_pen_id = null;
        $movement->previous_type = "replacement";
        $movement->current_type = "replacement";
        $movement->activity = "mortality";
        $movement->number_male = $request->male;
        $movement->number_female = $request->female;
        $movement->number_total = $request->male + $request->female;
        $movement->remarks = $request->remarks;

        $mortality = new MortalitySale;
        $mortality->date = $request->date;
        $mortality->replacement_inventory_id = $request->replacement_id;
        $mortality->type = "replacement";
        $mortality->category = "died";
        $mortality->male = $request->male;
        $mortality->female = $request->female;
        $mortality->total = $request->male + $request->female;
        $mortality->reason = $request->reason;
        $mortality->remarks = $request->remarks;

        $replacement_inventory->save();
        $replacement_pen->save();
        $movement->save();
        $mortality->save();
        return response()->json(['status' => 'success', 'message' => 'Replacement mortality recorded']);
    }

    public function addSale (Request $request)
    {
        $replacement_inventory = ReplacementInventory::where('id', $request->replacement_id)->firstOrFail();
        if($request->male > $replacement_inventory->number_male || $request->female > $replacement_inventory->number_female){
            return response()->json( ['error'=>'Input too quantity is too large for the inventory'] );
        }

        $replacement_pen = Pen::where('id', $replacement_inventory->pen_id)->firstOrFail();
        $replacement_inventory->number_male = $replacement_inventory->number_male - $request->male;
        $replacement_inventory->number_female = $replacement_inventory->number_female - $request->female;
        $replacement_inventory->total = $replacement_inventory->total - ($request->male + $request->female);

        $replacement_pen->current_capacity = $replacement_pen->current_capacity - ($request->male + $request->female);

        $movement = new AnimalMovement;
        $movement->date = $request->date;
        $movement->family_id = $replacement_inventory->getReplacementData()->family_id;
        $movement->tag = $replacement_inventory->tag;
        $movement->previous_pen_id = $replacement_pen->id;
        $movement->current_pen_id = null;
        $movement->previous_type = "replacement";
        $movement->current_type = "replacement";
        $movement->activity = "sale";
        $movement->number_male = $request->male;
        $movement->number_female = $request->female;
        $movement->number_total = $request->male + $request->female;
        $movement->remarks = $request->remarks;

        $sales = new MortalitySale;
        $sales->date = $request->date;
        $sales->replacement_inventory_id = $request->replacement_id;
        $sales->type = "replacement";
        $sales->category = "sold";
        $sales->male = $request->male;
        $sales->female = $request->female;
        $sales->total = $request->male + $request->female;
        $sales->price = $request->price;
        $sales->remarks = $request->remarks;

        $replacement_inventory->save();
        $replacement_pen->save();
        $movement->save();
        $sales->save();
        return response()->json(['status' => 'success', 'message' => 'Replacement sales recorded']);
    }

    public function addEggSale (Request $request)
    {
        $record = new MortalitySale;
        $record->replacement_inventory_id = $request->replacement_id;
        $record->type = "egg";
        $record->category = "sold";
        $record->total = $request->eggs;
        $record->price = $request->price;
        $record->remarks = $request->remarks;
        $record->date = $request->date;
        $record->save();
        return response()->json(['status' => 'success', 'message' => 'Egg sales added']);
    }

    public function cullReplacement ($inventory_id)
    {
        $now = Carbon::now();
        $inventory = ReplacementInventory::where('id', $inventory_id)->firstOrFail();
        $pen = Pen::where('id', $inventory->pen_id)->firstOrFail();
        $pen->current_capacity = $pen->current_capacity - $inventory->total;

        $movement = new AnimalMovement;
        $movement->date = $now->toDateString();
        $movement->family_id = $inventory->getReplacementData()->family_id;
        $movement->tag = $inventory->replacement_tag;
        $movement->previous_pen_id = $pen->id;
        $movement->current_pen_id = null;
        $movement->previous_type = "replacement";
        $movement->current_type = "replacement";
        $movement->activity = "cull";
        $movement->number_male = $inventory->number_male;
        $movement->number_female = $inventory->number_female;
        $movement->number_total = $inventory->number_male + $inventory->number_female;

        $movement->save();
        $pen->save();
        $inventory->delete();
        return response()->json(['status' => 'success', 'message' => 'Culled replacement']);
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

    public function getBrooderInventories ($family_id)
    {
        $brooders = BrooderGrowerInventory::
        join('brooder_growers', 'brooder_growers.id', 'brooder_grower_inventories.broodergrower_id')
        ->join('pens', 'pens.id','brooder_grower_inventories.pen_id')
        ->select('brooder_grower_inventories.*', 'brooder_growers.*', 'pens.*',
        'brooder_grower_inventories.id as inv_id', 'brooder_growers.id as bg_id', 'pens.id as pen_id')
        ->where('brooder_growers.family_id', $family_id)
        ->get();
        return $brooders;
    }

    public function updateMaleAndFemale(Request $request)
    {
        $date = Carbon::now();
        $request->validate([
            'inventory_id' => 'required',
            'number_male' => 'required',
            'number_female' => 'required',
        ]);
        $inventory = ReplacementInventory::where('id', $request->inventory_id)->firstOrFail();
        $replacement = Replacement::where('id', $inventory->replacement_id)->firstOrFail();
        $movement = new AnimalMovement;
        $movement->date = $date->toDateString();
        $movement->family_id = $replacement->family_id;
        $movement->tag = $inventory->replacement_tag;
        $movement->previous_pen_id = null;
        $movement->current_pen_id  = $inventory->pen_id;
        $movement->previous_type = 'replacement';
        $movement->current_type = 'replacement';
        $movement->activity = 'update';
        $movement->number_male = $request->number_male;
        $movement->number_female = $request->number_female;
        $movement->number_total = $inventory->total;
        $movement->remarks = null;

        $inventory->number_male = $request->number_male;
        $inventory->number_female = $request->number_female;

        $movement->save();
        $inventory->save();
        return response()->json(['status' => 'success', 'message' => 'Replacement updated']);
    }
}
