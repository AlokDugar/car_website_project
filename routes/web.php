<?php

use App\Http\Controllers\auth\AdminForgotController;
use App\Http\Controllers\auth\AdminLoginController;
use App\Http\Controllers\auth\AdminResetController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DashboardCarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\CustomAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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




Route::middleware('guest:admin')->group(function () {

    Route::get('/adminlogin', [AdminLoginController::class, 'showLoginForm'])->name('auth.adminLogin');
    Route::post('/adminlogin', [AdminLoginController::class, 'login']);

    Route::get('/adminforgot-password', [AdminForgotController::class, 'showLinkRequestForm'])->name('password.adminRequest');
    Route::post('/adminforgot-password', [AdminForgotController::class, 'sendResetLink'])->name('password.adminEmail');

    Route::get('/adminreset-password/{token}', [AdminResetController::class, 'showResetForm'])->name('password.adminReset');
    Route::post('/adminreset-password', [AdminResetController::class, 'resetPassword'])->name('password.adminUpdate');

});


Route::get('/admin_dashboard',function(){
    return view('dashboard.index');
})->name('dashboard.index')->middleware(AdminAuth::class);

Route::post('/adminlogout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/adminlogin')->with('success', 'You have been logged out!');
})->name('adminlogout')->middleware(AdminAuth::class);

Route::resource('dashboard_users', UserController::class)->middleware(AdminAuth::class);
Route::resource('dashboard_cars',DashboardCarController::class)->middleware(AdminAuth::class);

Route::get('/get-models/{id}',[DashboardCarController::class,'getModels'])->middleware(AdminAuth::class);
Route::get('/get-cities/{id}',[DashboardCarController::class,'getCities'])->middleware(AdminAuth::class);



