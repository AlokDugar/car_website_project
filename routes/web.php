<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index']);

Route::fallback(function(){
    return("Fallback! Non-existent");
});
Route::get('/car/search',[CarController::class,'search'])->name('car.search');
Route::get('/car/watchlist',[CarController::class,'watchlist'])->name('car.watchlist');

Route::resource('car',CarController::class);
Route::get('/SignUp',[SignUpController::class,'create'])->name('SignUp');
Route::get('/LogIn',[LoginController::class,'create'])->name('LogIn');
