<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhenoMorphosTableModel;

class PhenoMorphosTableController extends Controller
{
    public function addPhenoMorphos(Request $request)
    {
    	$pen = new PhenoMorphosTableModel($request->all());
    	$pen->save();
    }
    public function getPhenoMorphos()
    {
    	   
    	  $phenoMorphos = PhenoMorphosTableModel::paginate(100);
        return $phenoMorphos;
    }
}
