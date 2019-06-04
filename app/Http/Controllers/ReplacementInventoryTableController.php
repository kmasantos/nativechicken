<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReplacementInventoryTableModel;

class ReplacementInventoryTableController extends Controller
{
    public function addReplacementInventory(Request $request)
    {
    	$replacement = new ReplacementInventoryTableModel($request->all());
    	$replacement->save();
    }

    public function getReplacementInventory()
    {
   
           $replacementInventory = ReplacementInventoryTableModel::paginate(100);
        
   
       
        return $replacementInventory;
    }

    public function editReplacementInventoryMaleFemale(Request $request)
    {
        $replacement = ReplacementInventoryTableModel::where('id', $request->replacement_inv_id)->firstOrFail();
        if($request->male != null){
            $replacement->number_male = $request->male;
        }
        if($request->female != null){
            $replacement->number_female = $request->female;
        }
        if($request->total_ != null){
            $replacement->total = $request->total_;
        }
        $replacement->save();
        
    }
        public function cullReplacementInventory(Request $request)
    {
        $replacement = ReplacementInventoryTableModel::where('replacement_tag', $request->tag)->firstOrFail();
        $replacement->deleted_at = $request->date;
        
      
        $replacement->save();
        
    }
}

