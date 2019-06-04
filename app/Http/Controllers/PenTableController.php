<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenTableModel;

class PenTableController extends Controller
{
    public function addPen(Request $request)
    {
    	$pen = new PenTableModel($request->all());
    	$pen->save();
    }
    public function getPen($farm_id)
    {
    	
    	  $pens = PenTableModel::where('farm_id', $farm_id)
        ->where('is_active', true)
        ->orderBy('type', 'asc')
        ->orderBy('number', 'asc')
        ->paginate(100);
        return $pens;
    }

    public function editPen(Request $request)
    {
        $pen = PenTableModel::where('id', $request->pen_id)->firstOrFail();
        if($request->pen_number != null){
            $pen->number = $request->pen_number;
        }
        if($request->pen_capacity!=null){
            if($request->pen_capacity >= $pen->current_capacity){
                $pen->total_capacity = $request->pen_capacity;
            }
        }
        $pen->save();
        
    }
    public function editPenCount(Request $request)
    {
        $pen = PenTableModel::where('number', $request->pen_number)->firstOrFail();
        if($request->pen_current != null){
            $pen->current_capacity = $request->pen_current;
        }
    
        $pen->save();
        
    }
}
