<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LineTableModel;

class LineTableController extends Controller
{
    public function addLine(Request $request)
    {
    	$line = new LineTableModel($request->all());
    	$line->save();
    }
     public function getLine($generation_id)
    {
        $lines = LineTableModel::where('generation_id', $generation_id)->where('is_active', true)
        ->paginate(100);
        return $lines;
    }

}
