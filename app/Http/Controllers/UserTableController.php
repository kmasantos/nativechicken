<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTableModel;

class UserTableController extends Controller
{
     public function getFarmID($email)
    {
    	
 
        return UserTableModel::where('email', $email)
        ->pluck('farm_id');
    }

}
