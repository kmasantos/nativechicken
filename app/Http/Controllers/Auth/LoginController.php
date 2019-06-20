<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Socialite;
use Google_Client;
use App\Models\User;
use Crypt;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $findUser = User::where('email', $user->email)->first();
        if(!is_null($findUser) && $findUser->blocked == false){
            if($findUser->role_id == 2){
                Auth::login($findUser, true);
                if($findUser->picture === null){
                    $findUser->picture = $user->getAvatar();
                    $findUser->save();
                }
                return redirect()->action('AdminController@index');
            }else{
                Auth::login($findUser, true);
                if($findUser->picture === null){
                    $findUser->picture = $user->getAvatar();
                    $findUser->save();
                }
                return redirect()->action('FarmController@index');
            }
        }else{
            return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
