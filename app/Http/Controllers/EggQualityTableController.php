<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EggQualityTableModel;

class EggQualityTableController extends Controller
{
    public function addEggQuality(Request $request)
    {
    	$egg_qual = new EggQualityTableModel($request->all());
    	$egg_qual->save();
    }

    public function getEggQuality()
    {
    	
        
          $egg_qual = EggQualityTableModel::paginate(100);
        
   
        return $egg_qual;
    
    }

        public function deleteEggQuality(Request $request)
    {
        $feeding = EggQualityTableModel::where('id', $request->ID)->firstOrFail();
        $feeding->deleted_at = $request->date;
        
      
        $feeding->save();
        
    }
}

