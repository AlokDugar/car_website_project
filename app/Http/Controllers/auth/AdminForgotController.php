<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class AdminForgotController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.admin.forgot');
    }
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email'
        ]);

        $status = Password::broker('admins')->sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('auth.adminLogin')
                            ->with('success', 'Password reset link sent! Check your email.');
        } else {
            return back()->withErrors(['email' => 'Failed to send reset link.']);
        }
    }

}
