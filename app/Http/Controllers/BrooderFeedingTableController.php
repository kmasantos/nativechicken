<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrooderFeedingTableModel;

class BrooderFeedingTableController extends Controller
{
    public function addBrooderFeeding(Request $request)
    {
    	$brooder_feeding = new BrooderFeedingTableModel($request->all());
    	$brooder_feeding->save();
    }

    public function getBrooderFeeding()
    {


        
          $feedingrecords = BrooderFeedingTableModel::paginate(1000);
        
   
        return $feedingrecords;
    
    }
    public function deleteBrooderFeedingRecord(Request $request)
    {
        $feeding = BrooderFeedingTableModel::where('id', $request->feeding_id)->firstOrFail();
        $feeding->deleted_at = $request->date;
        
      
        $feeding->save();
        
    }
}

