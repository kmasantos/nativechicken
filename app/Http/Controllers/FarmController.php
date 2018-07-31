<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function getPensPage()
    {
        return view('general.pens');
    }

    
}
