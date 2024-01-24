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
Route::post('/setpasswordandauth', [\App\Http\Controllers\Controller::class ,'setpasswordandauth'])->name('setpasswordandauth');
Route::get('/googleCallback', [\App\Http\Controllers\Googlecontroller::class,'callback']);
Route::get('/googleredirect', [\App\Http\Controllers\Googlecontroller::class ,'directToGoogle'])->name('Register');
Route::get('/login', [\App\Http\Controllers\GoogleController::class ,'getlogin'])->name('login');
Route::post('/postlogin', [\App\Http\Controllers\GoogleController::class ,'login'])->name('postlogin');


Route::get('/',[\App\Http\Controllers\Controller::class ,'page'])->name('welcome');

Route::middleware(['userAdmin','fromUrlInApp'])->group(function(){
    //only admin can access this route.
    //Route::get('/dashboard',[\App\Http\Controllers\Controller::class ,'dashboard']);
    Route::post('/store',[\App\Http\Controllers\Controller::class,'store']);
    Route::post('/update/{id}',[\App\Http\Controllers\Controller::class,'update']);
    Route::get('/logout',[\App\Http\Controllers\GoogleController::class ,'logout']);
});
