<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FarmTableModel;
use Carbon\Carbon;

class FarmTableController extends Controller
{

     public function getFarmBatchingWeek($farm_id)
    {
         return FarmTableModel::where('id', $farm_id)
        ->pluck('batching_week');
    }
    public function getTimeStamp($farm_id){
         $code = FarmTableModel::where('id', $farm_id)->pluck('code');
         $code = str_replace(array('["','"]'),'',$code);
         $timestamp = Carbon::now()->timestamp;
         $random = random_bytes(1);
         $tag = $code.bin2hex($random).$timestamp;
         return $tag;
    }
    public Function getFarmInfo($farm_id){
        return FarmTableModel::where('id', $farm_id)
        ->get();
        
    }
    public function editFarm(Request $request)
    {
        $pen = FarmTableModel::where('id', $request->farm_id)->firstOrFail();
        if($request->farm_name != null){
            $pen->name = $request->farm_name;
        }
         if($request->farm_address != null){
            $pen->address = $request->farm_address;
        }
         if($request->farm_batching_week != null){
            $pen->batching_week = $request->farm_batching_week;
        }
    
        $pen->save();
        
    }
}
