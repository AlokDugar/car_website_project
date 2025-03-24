<?php

namespace App\Http\Controllers;

use App\Exports\UsersDataExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserDetailsMail;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.users', compact('users'));
    }

    /**
     * Store a newly created user (from modal form).
     */
    public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'nullable|string|min:10|max:10',
    ]);

    $password = Str::random(6);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($password);
    $user->phone = $request->phone;
    $user->save();

    Mail::to($request->email)->send(new UserDetailsMail($user, $password));

    return redirect()->route('dashboard_users.index')->with('success', 'User created successfully!');
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
        'phone' => 'nullable|string|min:10|max:10'.$user->id,
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
        return redirect()->route('dashboard_users.index');
    }

    public function downloadExcel()
{
    return Excel::download(new UsersDataExport, 'users.xlsx');
}

public function generatePDF()
    {
        $users = User::all();

        $data = [
            'title' => 'User Details',
            'users' => $users
        ];

        $pdf = FacadePdf::loadView('pdf.usersView', $data);
        return $pdf->download('users-lists.pdf');
    }

}
