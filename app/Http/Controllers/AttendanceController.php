<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    //
    public function index()
    {
        $attendances = Attendance::orderBy('created_at', 'desc')->get();
        return view('admin.db-attendance', compact('attendances'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'check_in' => 'required|string',
            'check_in_message' => 'nullable|string',
        ]);

        Attendance::create([
            'name' => $request->name,
            'check_in' => $request->check_in,
            'check_in_message' => $request->check_in_message,
        ]);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }

    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendances = Attendance::all();
        return view('admin.db-attendance', compact('attendance', 'attendances'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'check_in' => 'required|string',
            'check_in_message' => 'nullable|string',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update([
            'name' => $request->name,
            'check_in' => $request->check_in,
            'check_in_message' => $request->check_in_message,
        ]);

        return redirect('/db/attendance')->with('success', 'Form updated successfully!');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect('/db/attendance')->with('success', 'Data has been deleted successfully.');
    }
}
