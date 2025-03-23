<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('dashboard.users', compact('users'));
    }

    /**
     * Store a newly created user (from modal form).
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        return redirect()->route('dashboard_users.index')->with('success', 'User created successfully.');
    }

    /**
     * Update the specified user (from modal form).
     */

public function update(Request $request, $id)
{

    $user = User::find($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:10'.$user->id,
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
    ]);

    return redirect()->route('dashboard_users.index')->with('success', 'User updated successfully.');
}


    /**
     * Remove the specified user (from delete modal).
     */
    public function destroy(User $dashboard_user) {
        $dashboard_user->delete();
        return redirect()->route('dashboard_users.index')->with('success', 'User deleted successfully.');
    }

}
