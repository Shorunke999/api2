<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'user' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        return $user->createToken($request->email)->plainTextToken;
    }
    public function Register(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $registered_user=\App\Models\User::where('email',$request->email)->first();
        //return response()->json($registered_user);
        if(!$registered_user){
            $user = \App\Models\User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'user' => true,
            ]);
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json(['token' => $token]);
         }else{
            return response()->json(['msg'=>'email is already registered']);
         }
    
        
    }
}
