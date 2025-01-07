<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceLocationController extends Controller
{
    public function create(Request $request) {
        $attendances = $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required',
            'attendance_at' => 'required',
        ]);

        $attendances['workspace_id'] = $request->workspace_id;
        $attendances['user_id'] = $request->user_id;
        $attendances['status'] = strip_tags($attendances['status']);
        $attendances['attendance_at'] = strip_tags($attendances['attendance_at']);

        Attendance::create($attendances);

        return back()->with('workspace', $request->workspace_id);
    }
}
