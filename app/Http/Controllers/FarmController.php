<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Pen;

class FarmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('general.dashboard');
    }

    /**
     * Show the pens list page
     * @param none
     * @return view
     * @return collection
     */    
    public function getPensPage()
    {
        $pens = Pen::where('is_active', true)->orderBy('type', 'asc')->paginate(15);
        return view('general.pens', compact('pens'));
    }
    
    /**
     * Post created pen to database
     * @param request
     * @return redirect
     */    
    public function addPen(Request $request)
    {
        $request->validate([
            'pen_number' => 'required',
            'type' => 'required',
            'pen_capacity' => 'required',
        ]);
        $new = new Pen;
        if($request->type === "brooder"){
            $new->number = "B".str_pad($request->pen_number, 2, '0', STR_PAD_LEFT);
        }elseif($request->type === "grower"){
            $new->number = "G".str_pad($request->pen_number, 2, '0', STR_PAD_LEFT);
        }elseif($request->type === "layer"){
            $new->number = "L".str_pad($request->pen_number, 2, '0', STR_PAD_LEFT);
        }
        $new->type = $request->type;
        $new->total_capacity = $request->pen_capacity;
        $new->current_capacity = 0;
        $new->save();
        $request->session()->flash('pen-create', 'Pen successfully created');
        return redirect()->route('farm.pens');
    }

    /**
     * Search pens from search request
     * @param request
     * @return view
     * @return collection
     */
    public function searchPen(Request $request)
    {
        if($request->search == null && $request->search_checkbox == null){
            return redirect()->route('farm.pens');
        }else{
            if($request->search_checkbox == null){
                $pens = Pen::where('is_active', true)
                ->where('number', 'like', '%'.$request->search.'%')
                ->paginate(15);
                return view('general.pens', compact('pens'));
            }else{
                $pens = Pen::where('is_active', true)
                ->where('number', 'like', '%'.$request->search.'%')
                ->whereIn('type', $request->search_checkbox)
                ->paginate(15);
                return view('general.pens', compact('pens'));
            }
        }
    }

    /**
     * Get farm settings page
     * @param none
     * @return view
     * @return variable
     */
    public function getFarmSettingPage()
    {
        if (Auth::check())
        {
            $farm = Auth::user()->getFarm();
            return view('general.farm_settings', compact('farm'));
        }
    }

    /**
     * Edit farm attributes
     * @param request
     * @return view
     * @return parameter
     */
    public function editFarmSetting(Request $request)
    {
        if (Auth::check())
        {
            $farm = Auth::user()->getFarm();
            if(!is_null($request->farm_name)){
                $farm->name = $request->farm_name;
            }
            if(!is_null($request->farm_address)){
                $farm->address = $request->farm_address;
            }
            if(!is_null($request->farm_batching_week) && $request->farm_batching_week>0 && $request->farm_batching_week <= 10){
                $farm->batching_week = $request->farm_batching_week;
            }
            $farm->save();
            return redirect()->back()->with('success', ['Farm settings edit successful']);   
        }
        else{
            return redirect()->back()->with('fail', ['Farm settings edit failed']); 
        }
    }
}
