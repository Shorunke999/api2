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
    Route::get('/index',[\App\Http\Controllers\putController::class ,'index']);
    Route::post('/search',[\App\Http\Controllers\putController::class ,'search']);
    Route::get('/show',[\App\Http\Controllers\putController::class ,'show']);

});
Route::post('/login',[\App\Http\Controllers\Controller::class ,'login']);
Route::post('/Register',[\App\Http\Controllers\Controller::class ,'Register']);
