<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    //return $request->user();
    //routes to be protected (user and admin only)
    Route::middleware('userAdmin')->group(function(){
        //only admin can access this path
    });

});
Route::post('/login',[\App\Http\Controllers\Controller::class ,'login']);
Route::post('/Register',[\App\Http\Controllers\Controller::class ,'Register']);
Route::get('/googleCallback', [\App\Http\Controllers\Googlecontroller::class ,'callback']);
