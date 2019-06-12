<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrooderGrowthTableModel;

class BrooderGrowthTableController extends Controller
{
    public function addBrooderGrowth(Request $request)
    {
        $brooder_Growth = new BrooderGrowthTableModel($request->all());
        $brooder_Growth->save();
    }

    public function getBrooderGrowth()
    {
     
          $growthrecords = BrooderGrowthTableModel::paginate(1000);
        
   
        return $growthrecords;
    }

    
}

