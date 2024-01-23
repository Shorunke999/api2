<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callback(){
        $userObject = Socialite::driver('google')->user();
        //create a new user and dd user object to the nature of user()
        //dd($userObject);--to see data which can be save to db
        $user = User::updateOrCreate([
            'user_id' => $userObject->id,
        ], [
            'name' => $userObject->name,
            'email' => $userObject->email,
            'google_token' => $userObject->token,
            'google_refresh_token' => $userObject->refreshToken,
        ]);
        Auth::login($user);
        return redirect('/dashboard');
        //return user token --the oauth token,
    }
    public function logout(){
        Auth::logout();
        return redirect('/welcome');
    }
}
