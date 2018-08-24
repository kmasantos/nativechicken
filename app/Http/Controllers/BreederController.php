<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Generation;
use App\Models\Line;

class BreederController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Get the generations page
     *
     * @return \Illuminate\Http\Response
     * @return collection
     */
    public function getGenerationsPage()
    {
        $generations = Generation::where('is_active', true)->orderBy('numerical_generation', 'desc')->paginate(15);
        return view('chicken.breeder.generation', compact('generations'));
    }

    public function addGeneration(Request $request)
    {
        $request->validate([
            'generation_number' => 'required'
        ]);
        $generation = new Generation;
        $generation->numerical_generation = $request->generation_number;
        $generation->number = str_pad($request->generation_number, 4, '0', STR_PAD_LEFT);
        $generation->is_active = true;
        $generation->save();
        if(!empty($request->line)){
            foreach($request->line as $line){
                $new = new Line;
                $new->number = $line;
                $new->is_active = true;
                $new->generation_id = $generation->id;
                $new->save();
            }
        }
        $request->session()->flash('generation-add', 'Generation successfully created');
        return redirect()->route('farm.chicken.breeder.generation');
    }

    public function getFamilyRecordsPage()
    {
        return view('chicken.breeder.family_record');
    }

    public function getFamilyRecordsPageNew()
    {
        return view('chicken.breeder.family_record_new');
    }
}
