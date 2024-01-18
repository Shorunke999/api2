<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->stateless()->redirect();
    }
    public function callback(){
        $userObject =Socialite::driver('google')->user();
        //create a new user and dd user object to the nature of user()
        //return user token --the oauth token,
        return response()->json(['msg' => $userObject->token]);
        //or
        //Auth::login($userObject);
        //return redirect('/');
    }
}
