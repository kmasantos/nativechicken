<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HatcheryRecordsTableModel;

class HatcheryRecordsTableController extends Controller
{
    public function addHatcheryRecords(Request $request)
    {
    	$hatchery = new HatcheryRecordsTableModel($request->all());
    	$hatchery->save();
    }

    public function getHatcheryRecords()
    {
    	
        
          $hatchery = HatcheryRecordsTableModel::paginate(100);
        
   
        return $hatchery;
    
    }

    public function deleteHatchery(Request $request)
    {
        $feeding = HatcheryRecordsTableModel::where('id', $request->ID)->firstOrFail();
        $feeding->deleted_at = $request->date;
        
      
        $feeding->save();
        
    }
}

