<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/welcome', [\App\Http\Controllers\putController::class ,'page'] );
Route::get('/googleCallback', [\App\Http\Controllers\Googlecontroller::class,'callback']);
Route::get('/googleredirect', [\App\Http\Controllers\Googlecontroller::class ,'redirect'])->name('login');

Route::middleware('userAdmin')->group(function(){
    //only admin can access this route.
    Route::get('/dashboard',[\App\Http\Controllers\putController::class ,'store']);
    Route::resource('/store',\App\Http\Controllers\putController::class)->only(['store' , 'update']);
    
    Route::get('/logout',[\App\Http\Controllers\GoogleController::class ,'logout']);
});
