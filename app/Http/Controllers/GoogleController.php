<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
    public function directToGoogle(){
        return Socialite::driver('google')->redirect();
    }
    public function callback(){
        $userObject = Socialite::driver('google')->stateless()->user();
        dd($userObject);
        $user = User::create([
            'name' => $userObject->name,
            'email' => $userObject->email,
            'role' => 1,
        ]);
        return view('passwordInput',['email'=>$userObject->email]);
        //return user token --the oauth token,
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'integer'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user){
            return redirect('/login')
            ->with('msg1','sign up');
        } elseif(!Hash::check($request->password, $user->password) || $request->role != 1){
            return redirect('/login')
            ->with('msg2','user cannot be verify. verify password with a valid role');
        }else{
            auth()->user();
            return view('dashboard');
        }
    }
    public function setpasswordandauth(Request $request){
        $savepassword = User::where('email',$request->email)
        ->create([
            'password'=>Hash::make($request->password)
        ]);
        auth()->login();
        return view('dashboard');
    }
    public function getlogin(){
        return view('login');
    }
    public function logout(){
        Auth::logout();
        return redirect('/welcome');
    }
}
