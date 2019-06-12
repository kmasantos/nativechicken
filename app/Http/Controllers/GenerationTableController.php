<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GenerationTableModel;
use App\Models\FarmTableModel;
use App\Models\PenTableModel;
use App\Models\LineTableModel;
use App\Models\FamilyTableModel;
use App\Models\BreederTableModel;
use App\Models\BreederInventoryTableModel;
use App\Models\ReplacementTableModel;
use App\Models\ReplacementInventoryTableModel;
use App\Models\BrooderTableModel;
/*use App\Models\BrooderGrowerInventoryTableModel
use App\Models\BreederFeedingTableModel;
use App\Models\ReplacementFeedingTableModel;
use App\Models\ReplacementGrowthTableModel;
use App\Models\BrooderGrowerFeedingTableModel;
use App\Models\BrooderGrowerGrowthTableModel;
use App\Models\HatcheryRecordTableModel;
use App\Models\EggQualityTableModel;
use App\Models\EggProductionTableModel;
use App\Models\MortalitySaleTableModel;
use App\Models\PhenoMorphoTableModel;
use App\Models\PhenoMorphoValueTableModel;*/

class GenerationTableController extends Controller
{
    public function addGeneration(Request $request)
    {$generation = new GenerationTableModel($request->all());
    	$generation->save();
    	
    }
    public function getGeneration($farm_id)
    {

    	  $generations = GenerationTableModel::where('farm_id', $farm_id)
        ->orderBy('numerical_generation', 'desc')
        ->paginate(1000);
        return $generations;
    }
    public function cullGeneration($generation_id)
    {
        $generation = GenerationTableModel::where('id', $generation_id)->first();
        $generation->is_active = false;
        $generation->save();
        $lines = LineTableModel::where('generation_id', $generation->id)->get();
        foreach($lines as $line){
            $families = FamilyTableModel::where('line_id', $line->id)->get();
            foreach($families as $family){
                $breeders = BreederTableModel::where('family_id', $family->id)->get();
                foreach($breeders as $breeder){
                    $inventories = BreederInventoryTableModel::where('breeder_id', $breeder->id)->get();
                    foreach($inventories as $inventory){
                        $pen = PenTableModel::where('id', $inventory->pen_id)->first();
                        if($pen->current_capacity != 0){
                            $pen->current_capacity = 0;
                            $pen->save();
                        }
                        $inventory->delete();
                    }
                    $breeder->delete();
                }
                $replacements = ReplacementTableModel::where('family_id', $family->id)->get();
                foreach($replacements as $replacement){
                    $inventories = ReplacementInventoryTableModel::where('replacement_id', $replacement->id)->get();
                    foreach($inventories as $inventory){
                        $pen = PenTableModel::where('id', $inventory->pen_id)->first();
                        if($pen->current_capacity != 0){
                            $pen->current_capacity = 0;
                            $pen->save();
                        }
                        $replacement->delete();
                    }
                    $breeder->delete();
                }
                $brooders = BrooderTableModel::where('family_id', $family->id)->get();
                foreach($brooders as $brooder){
                    $inventories = BrooderInventoryTableModel::where('broodergrower_id', $brooder->id)->get();
                    foreach($inventories as $inventory){
                        $pen = PenTableModel::where('id', $inventory->pen_id)->first();
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
       
    }
}
