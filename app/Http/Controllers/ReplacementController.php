<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Replacement;

class ReplacementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getAddReplacement()
    {
        return view('chicken.replacement.add_replacement');
    }

    public function getReplacementList()
    {
        $replacements = Replacement::get();
        return $replacements;
    }

    public function phenoMorphoPage()
    {
        return view('chicken.replacement.phenomorpho_record');
    }

    public function feedingRecordPage()
    {
        return view('chicken.replacement.feeding_record');
    }
}
