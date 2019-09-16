<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Farm;
use App\Models\Role;
use App\Models\Breed;
use App\Models\News;
use Carbon\Carbon;

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

    public function newsManagementPage()
    {
        return view('admin.news');
    }

    public function reportsManagementPage()
    {
        return view('admin.reports');
    }

    public function farmStatusPage() 
    {
        return view('admin.status');
    }
    
    public function createUser(Request $request) 
    {
        try{
            $request->validate([
                'username' => 'required',
                'email' => 'required',
                'farm_code' => 'required',
                'farm_name' => 'required',
                'farm_address' => 'required',
                'breed_selected' => 'required',
            ]);

            if(User::where('email', '=', $request->email)->count() > 0){
                return response()->json(['error'=>'Email already exists']);
            }
            if(Farm::where('code', '=', $request->farm_code)->count() > 0){
                return response()->json(['error'=>'Farm code already exists']);
            }

            try{
                $farm = new Farm;
                $user = new User;
                $farm->name = $request->farm_name;
                $farm->code = $request->farm_code;
                $farm->address = $request->farm_address;
                $farm->breedable_id = $request->breed_selected;
                $farm->save();
                $user->name = $request->username;
                $user->email = $request->email;
                $user->farm_id = $farm->id;
                $role = Role::find(1);
                $user->role_id = $role->id;
                $user->save();
                return response()->json(['success' => $user->name]);
            }catch(Exception $exception) {
                return response()->json(['error'=>'Failed to create user']);
            }
        }catch(Exception $exception){
            return response()->json(['error'=>'Incomplete input']);
        }
    }

    public function blockUnblockUser($user)
    {
        $user = User::find($user);
        $user->blocked = !$user->blocked;
        $user->save();
        return response()->json(['success' => $user->name]);
    }

    public function deleteUser($user)
    {
        $user = User::find($user);
        $name = $user->name;
        $user->delete();
        return response()->json(['success' => $name]);
    }

    public function editUser(Request $request)
    {
        $user = User::find($request->user);
        if(!empty($user)){
            if(!empty($request->username) || !empty($request->email)){
                if(!empty($request->username)){
                    $user->name = $request->username;
                }
                if(!empty($request->email)){
                    $check_email = User::where('email', $request->email)->first();
                    if(empty($check_email)){
                        $user->email = $request->email;    
                    }
                }
                $user->save();
            }
            if(!empty($request->farm_code)){
                $farm = Farm::find($user->farm_id);
                $farm->code = $request->farm_code;
                $farm->save();
            }
            return response()->json(['success' => "Successfully edited ".$user->name]);
        }
        return response()->json(['error' => "Failed to edit ".$user->name]);
    }

    // News

    public function addNews(Request $request)
    {
        $news = new News;
        $news->title = $request->title;
        $news->content = $request->content;
        $news->save();

       return response()->json([
            'news' => $news
        ]);
    }

    public function editNews(Request $request)
    {
        $news = News::find($request->id);
        if ($news) {
            $news->title = $request->title;
            $news->content = $request->content;
            $news->updated_at = now();
            $news->save();
            return response()->json([
                'news' => $news
            ]);
        }

        else return response()->json([
            'error' => 'News Not Found'
        ], 404);
    }


    public function publishNews($news_id)
    {
        $news = News::find($news_id);
        $news->published_at = now();
        $news->save();

        return response()->json([
            'news' => $news
        ]);
    }

    public function archiveNews($news_id)
    {
        $news = News::find($news_id);
        $news->archived_at = now();
        $news->save();

        return response()->json([
            'news' => $news
        ]);
    }

    /**
     ** Helper Functions
    **/

    public function getNewsList(Request $request)
    {
        $news = News::paginate(10);
        return $news;
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

    public function getBreedList () 
    {
        $breeds = Breed::all();
        return $breeds;
    }
    
}
