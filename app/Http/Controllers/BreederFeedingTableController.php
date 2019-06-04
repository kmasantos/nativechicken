<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BreederFeedingTableModel;

class BreederFeedingTableController extends Controller
{
    public function addBreederFeeding(Request $request)
    {
    	$breeder_feeding = new BreederFeedingTableModel($request->all());
    	$breeder_feeding->save();
    }

    public function getBreederFeeding()
    {
    	


        
          $feedingrecords = BreederFeedingTableModel::paginate(100);
        
   
        return $feedingrecords;
    
    }

    public function deleteBreederFeedingRecord(Request $request)
    {
        $feeding = BreederFeedingTableModel::where('id', $request->feeding_id)->firstOrFail();
        $feeding->deleted_at = $request->date;
        
      
        $feeding->save();
        
    }
}

