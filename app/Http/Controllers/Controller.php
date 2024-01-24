<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Mail;
use App\Jobs\registeredMailjob;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'integer'
        ]);
        $user = User::where('email', $request->email)->first();
 
        if (!$user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        //Mail::to($request->email)->send(new \App\Mail\new_mail());
        return $user->createToken($request->email)->plainTextToken;
    }
    public function Register(Request $request){
        $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'role'=> 'integer'
        ]);
        $registered_user= \App\Models\User::where('email',$request->email)->first();
        if(!$registered_user){
            $user = \App\Models\User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role'=> 1,
            ]);
            //registeredMailjob::dispatch($request);
            $token = $user->createToken($request->email)->plainTextToken;
            return response()->json(['token' => $token]);
         }else{
            return response()->json(['msg'=>'email is already registered']);
         }
    
        
    }
    public function page(){
        return view('welcome');
    }
    public function store(Request $request){
        $request->validate([
            'result_id' => 'required',
            'polling_unit_uniqueid' => 'required|string',
            'party_abbreviation' => 'required',
            'party_score' => 'required',
            'entered_by_user'=> 'required|string'
        ]);
        $saved_data = p_u_t::create($request);
        return response()->json(['msg' => 'the data have been succesfully save']);
    }

    public function update(Request $request, string $id){
        $request->validate([
                'result_id' => 'required',
                'polling_unit_uniqueid' => 'required|string',
                'party_abbreviation' => 'required',
                'party_score' => 'required',
                'entered_by_user'=> 'required|string'
        ]);
        $data_db =p_u_t::findOrFail($id);
       if(!$data_db){
        return new modelException('data with the id is not available');
       }else{
        $data= $data_db->update($request);
        return response()->json(['msg'=>'data has been updated']);
       }
    }
    /*public function page(){
        return view('welcome');
    }*/
}
