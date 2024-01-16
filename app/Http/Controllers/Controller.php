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
            'device_name' => 'required',
            'user_type' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    
        return $user->createToken($request->device_name)->plainTextToken;
    }
    public function Register(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
            'user_type' => 'boolean',
        ]);
        if($request->user_type == 'admin' ||$request->user_type =='user'){
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'device_name' => $request->device_name,
                'user_type' => $request->user_type,
            ]);
            $token = $user->createToken($request->device_name)->plainTextToken;
            return response()->json(['token' => $token]);

        }
    
        
    }
}
