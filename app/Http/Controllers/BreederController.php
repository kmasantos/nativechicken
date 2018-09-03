<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Generation;
use App\Models\Line;
use App\Models\Family;

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
                $new->number = str_pad($line, 4, '0', STR_PAD_LEFT);
                $new->is_active = true;
                $new->generation_id = $generation->id;
                $new->save();
            }
        }
        $request->session()->flash('generation-add', 'Generation successfully created');
        return redirect()->route('farm.chicken.breeder.generation');
    }
    
    public function cullGeneration(Request $request)
    {
        
    }

    public function searchGeneration(Request $request)
    {   
        $generations = Generation::where('is_active', true)
                ->where('number', 'like', '%'.$request->search.'%')
                ->paginate(15);
        return view('chicken.breeder.generation', compact('generations'));
    }

    public function addLine(Request $request)
    {
        $request->validate([
            'add_line_gen_id' => 'required',
            'add_line' => 'required'
        ]);
        if(!empty($request->add_line)){
            foreach($request->add_line as $line){
                $new = new Line;
                $new->number = str_pad($line, 4, '0', STR_PAD_LEFT);
                $new->is_active = true;
                $new->generation_id = $request->add_line_gen_id;
                $new->save();
            }
        }
        return redirect()->route('farm.chicken.breeder.generation');
    }

    public function getFamilyRecordsPage()
    {
        $generations = Generation::where('is_active', true)->get();
        $families = Family::where('is_active', true)->paginate(15);
        return view('chicken.breeder.family_record', compact('generations','families'));
    }

    public function getLinesOfGeneration($generation)
    {
        $lines = Lines::where('generation_id', $generation)->where('is_active', true)->get();
        return $lines;
    }

    public function addFamilyRecord(Request $request)
    {
        dd($request);
    }

    public function searchFamilyRecordsPage(Request $request)
    {
        $families = Family::where('is_active', true)
                    ->where('number', 'like', '%'.$request->search.'%')
                    ->paginate(15);
        dd($families);
    }

    public function getFamilyRecordsPageNew()
    {
        return view('chicken.breeder.family_record_new');
    }
}
