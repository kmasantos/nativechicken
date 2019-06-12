<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MortalityAndSalesTableModel;

class MortalityAndSalesTableController extends Controller
{
    public function addMortalityAndSales(Request $request)
    {
    	$mort = new MortalityAndSalesTableModel($request->all());
    	$mort->save();
    }
    public function getMortalityAndSales()
    {
    	
    	  $mort = MortalityAndSalesTableModel::paginate(1000);
        return $mort;
    }
}
