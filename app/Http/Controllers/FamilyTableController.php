<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyTableModel;

class FamilyTableController extends Controller
{
    public function addFamily(Request $request)
    {
    	$family = new FamilyTableModel($request->all());
    	$family->save();
    }
     public function getFamilyForDisplay($farm_id)
    {
        $families = FamilyTableModel::
        join('lines', 'families.line_id', '=', 'lines.id')
        ->join('generations', 'lines.generation_id', '=', 'generations.id')
        ->where('generations.farm_id', $farm_id)
        ->where('families.is_active', true)
        ->select('lines.number AS line_number', 'families.number AS family_number',
        'families.is_active as is_active', 'generations.number AS generation_number')
        ->orderBy('generations.number', 'desc')
        ->orderBy('lines.number', 'desc')
        ->orderBy('families.number', 'asc')
        ->paginate(100);
        return $families;
    }
    public function getFamily()
    {

    	  $families = FamilyTableModel::where('is_active', true)
        ->orderBy('id', 'desc')
        ->paginate(1000);
        return $families;
    }

}
