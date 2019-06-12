<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhenoMorphoValuesTableModel;

class PhenoMorphoValuesTableController extends Controller
{
    public function addPhenoMorphoValues(Request $request)
    {
    	$pen = new PhenoMorphoValuesTableModel($request->all());
    	$pen->save();
    }
    public function getPhenoMorphoValues()
    {
    	   
    	  $phenoMorphoValues = PhenoMorphoValuesTableModel::paginate(1000);
        return $phenoMorphoValues;
    }
}
