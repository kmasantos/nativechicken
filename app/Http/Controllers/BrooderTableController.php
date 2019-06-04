<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrooderTableModel;

class BrooderTableController extends Controller
{
    public function addBrooderFamily(Request $request)
    {
    	$brooder = new BrooderTableModel($request->all());
    	$brooder->save();
    }
    public function getBrooder()
    {
    	
    	  $brooder = BrooderTableModel::paginate(100);
    	
   
        return $brooder;
    }
}
