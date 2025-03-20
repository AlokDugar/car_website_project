<?php

use App\Http\Controllers\auth\AdminForgotController;
use App\Http\Controllers\auth\AdminLoginController;
use App\Http\Controllers\auth\AdminResetController;
use App\Http\Controllers\DashboardCarController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


