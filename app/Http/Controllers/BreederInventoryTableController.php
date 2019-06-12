<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BreederInventoryTableModel;
use App\Models\BreederTableModel;

class BreederInventoryTableController extends Controller
{
    public function addBreederInventory(Request $request)
    {
    	$breeder = new BreederInventoryTableModel($request->all());
    	$breeder->save();
    }

    public function getBreederInventory()
    {
     
        $breederInventory = BreederInventoryTableModel::paginate(10000);


        
   
       
         return $breederInventory;

        /*             "id": 1,
            "breeder_id": 1,
            "pen_id": 6,
            "breeder_tag": "FAM2f1547181813",
            "batching_date": "2019-01-31",
            "number_male": 4,
            "number_female": 4,
            "total": 8,
            "last_update": "2019-01-24",
            "deleted_at": null*/
/*        $inventories = BreederInventoryTableModel::
        leftJoin('breeders', 'breeder_inventories.breeder_id', 'breeders.id')
        ->leftJoin('families', 'breeders.family_id', 'families.id')
        ->leftJoin('lines', 'families.line_id', 'lines.id')
        ->leftJoin('generations', 'lines.generation_id', 'generations.id')
        ->where('total', '>', 0)
        ->where('generations.farm_id', $farm_id)
        ->select('breeder_inventories.*', 'breeders.*','families.*',
        'breeder_inventories.id as inventory_id','breeders.id as breeder_id','families.id as family_id','families.number as family_number',
        'lines.number as line_number', 'generations.number as generation_number')
        ->paginate(100);
        return $inventories;*/
    }
    public function editBreederInventoryMaleFemale(Request $request)
    {
        $brooder = BreederInventoryTableModel::where('id', $request->breeder_inv_id)->firstOrFail();
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
    public function cullBreederInventory(Request $request)
    {
        $breeder = BreederInventoryTableModel::where('breeder_tag', $request->tag)->firstOrFail();
        $breeder->deleted_at = $request->date;
        
      
        $breeder->save();
        
    }
    
}

