<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplacementTableModel;

class ReplacementTableController extends Controller
{
    public function addReplacementFamily(Request $request)
    {
    	$replacement = new ReplacementTableModel($request->all());
    	$replacement->save();
    }
    public function getReplacement()
    {
    	
    	  $replacement = ReplacementTableModel::paginate(10000);
    	
   
        return $replacement;
    }
}
