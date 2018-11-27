<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     * TODO Redirect to different view if admin is logged in
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Farm landing page
        return view('general.dashboard');
    }
}
