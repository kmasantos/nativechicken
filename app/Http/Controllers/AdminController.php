<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Farm;
use App\Models\Role;

class AdminController extends Controller
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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }

    public function userManagementPage()
    {
        return view('admin.user');
    }

    public function contentManagementPage()
    {
        return view('admin.content');
    }

    public function farmStatusPage() 
    {
        return view('admin.status');
    }

    public function getUserList ()
    {
        $users = User::join('farms', 'users.farm_id', 'farms.id')
            ->join('roles', 'users.role_id', 'roles.id')
            ->where('users.id', '!=', Auth::user()->id)
            ->select('users.*', 'farms.*', 'roles.*', 'users.id as user_id', 'farms.id as farm_id', 'roles.id as role_id', 
            'users.name as user_name', 'farms.name as farm_name')
            ->paginate(10);
        return $users;
    } 

}
