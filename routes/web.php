<?php

use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Middleware\CustomAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ModelController;

Route::get('/home', [HomeController::class,'index'])->middleware(CustomAuth::class);

Route::fallback(function(){
    return("Fallback! Non-existent");
});
Route::get('/car/search',[CarController::class,'search'])->name('car.search')->middleware(CustomAuth::class);
Route::get('/car/watchlist',[CarController::class,'watchlist'])->name('car.watchlist')->middleware(CustomAuth::class);

Route::resource('car',CarController::class)->middleware(CustomAuth::class);

Route::get('/', [LoginController::class, 'showLoginForm']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('/login', [LoginController::class, 'login']);

Route::get('/register', [SignUpController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('/register', [SignUpController::class, 'register']);

Route::get('/dashboard',function(){
    return view('dashboard.index');
});

Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/auth/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')->with('success', 'You have been logged out!');
})->name('logout')->middleware(CustomAuth::class);

Route::get('/filter-models', [ModelController::class, 'filter'])->name('filter.models');

