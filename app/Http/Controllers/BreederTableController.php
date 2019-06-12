<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BreederTableModel;

class BreederTableController extends Controller
{
    public function addBreederFamily(Request $request)
    {
    	$breeder = new BreederTableModel($request->all());
    	$breeder->save();
    }
    public function getBreeder()
    {
    	
    	  $breeder = BreederTableModel::paginate(10000);
    	
   
        return $breeder;
    }
}
