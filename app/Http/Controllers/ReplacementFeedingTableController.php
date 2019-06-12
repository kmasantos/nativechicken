<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplacementFeedingTableModel;

class ReplacementFeedingTableController extends Controller
{
    public function addReplacementFeeding(Request $request)
    {
    	$replacement_feeding = new ReplacementFeedingTableModel($request->all());
    	$replacement_feeding->save();
    }

    public function getReplacementFeeding()
    {
    	 

        
          $feedingrecords = ReplacementFeedingTableModel::paginate(10000);
        
   
        return $feedingrecords;
    
    }
    public function deleteReplacementFeedingRecord(Request $request)
    {
        $feeding = ReplacementFeedingTableModel::where('id', $request->feeding_id)->firstOrFail();
        $feeding->deleted_at = $request->date;
        
      
        $feeding->save();
        
    }
    
}

