<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
        if(Auth::user()->role_id === 1){
            return view('general.dashboard');
        }else if(Auth::user()->role_id === 2){
            return view('admin.home');
        }
        
    }
}
