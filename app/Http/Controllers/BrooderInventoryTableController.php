<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrooderInventoryTableModel;


class BrooderInventoryTableController extends Controller
{
    public function addBrooderInventory(Request $request)
    {
    	$brooder = new BrooderInventoryTableModel($request->all());
    	$brooder->save();
    }

    public function getBrooderInventory()
    {

           $brooderInventory = BrooderInventoryTableModel::paginate(10000);
        
   
       
        return $brooderInventory;
    }

    public function editBrooderInventoryMaleFemale(Request $request)
    {
        $brooder = BrooderInventoryTableModel::where('id', $request->brooder_inv_id)->firstOrFail();
        if($request->male != null){
            $brooder->number_male = $request->male;
        }
        if($request->female != null){
            $brooder->number_female = $request->female;
        }
        if($request->total_ != null){
            $brooder->total = $request->total_;
        }
      
        $brooder->save();
        
    }
     public function cullBrooderInventory(Request $request)
    {
        $brooder = BrooderInventoryTableModel::where('broodergrower_tag', $request->tag)->firstOrFail();
     	$brooder->deleted_at = $request->date;
        
      
        $brooder->save();
        
    }


}

