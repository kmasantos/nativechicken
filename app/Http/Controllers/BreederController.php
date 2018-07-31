<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BreederController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getGenerationsPage()
    {
        return view('chicken.breeder.generation');
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
