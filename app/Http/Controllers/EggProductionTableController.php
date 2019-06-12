<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EggProductionTableModel;

class EggProductionTableController extends Controller
{
    public function addEggProduction(Request $request)
    {
    	$breeder_feeding = new EggProductionTableModel($request->all());
    	$breeder_feeding->save();
    }

    public function getEggProduction()
    {
    	
        
          $eggProd = EggProductionTableModel::paginate(1000);
        
   
        return $eggProd;
    
    }
    public function deleteEggProduction(Request $request)
    {
        $feeding = EggProductionTableModel::where('id', $request->ID)->firstOrFail();
        $feeding->deleted_at = $request->date;
        
      
        $feeding->save();
        
    }
    
}

