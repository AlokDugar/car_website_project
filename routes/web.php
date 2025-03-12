<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
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
Route::get('/dashboard',function(){
    return view('dashboard.index');
});
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('/admin_login', [AuthLoginController::class, 'showLoginForm'])->name('admin_login');
        Route::post('/admin_login', [AuthLoginController::class, 'login']);

        Route::get('/admin_forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/admin_forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

        Route::get('/admin_reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/admin_reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
    });

    Route::middleware('auth:admin')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    });
});
