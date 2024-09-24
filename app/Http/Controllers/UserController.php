<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('admin.db-user', compact('users'));
    }

    public function edit($id)
    {
        $attendance = User::findOrFail($id);
        $attendances = User::all();
        return view('admin.db-attendance', compact('attendance', 'attendances'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'check_in' => 'required|string',
            'check_in_message' => 'nullable|string',
        ]);

        $attendance = User::findOrFail($id);
        $attendance->update([
            'name' => $request->name,
            'check_in' => $request->check_in,
            'check_in_message' => $request->check_in_message,
        ]);

        return redirect('/db/attendance')->with('success', 'Form updated successfully!');
    }
}
