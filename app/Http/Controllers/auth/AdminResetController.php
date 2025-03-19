<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\Admin;

class AdminResetController extends Controller
{
    public function showResetForm($token)
    {
        return view('auth.admin.reset', ['token' => $token]);
    }

    public function resetPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:admins,email',
        'password' => 'required|min:6|confirmed',
        'token' => 'required'
    ]);

    $status = Password::broker('admins')->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (Admin $admin, string $password) {
            $admin->forceFill(['password' => Hash::make($password)])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('auth.adminLogin')->with('success', 'Password reset successfully.')
        : back()->withErrors(['email' => 'Failed to reset password.']);
}
}
