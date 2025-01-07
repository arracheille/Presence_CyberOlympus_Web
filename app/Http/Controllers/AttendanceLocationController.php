<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLocation;
use Illuminate\Http\Request;

class AttendanceLocationController extends Controller
{
    public function create(Request $request) {
        $locations = $request->validate([
            'workspace_id' => 'required|exists:workspaces,id',
            'name' => 'required|string',
            'geofence' => 'required|array',
            'geofence.*.lat' => 'required|numeric',
            'geofence.*.lng' => 'required|numeric'
        ]);

        // foreach ($locations['geofence'] as $coordinate) {
            AttendanceLocation::create([
                // 'latitude' => $coordinate['lat'],
                // 'longitude' => $coordinate['lng'],
                'geofence' => $locations['geofence'],
                'name' => $locations['name'],
                'workspace_id' => $locations['workspace_id']
            ]);
        // }
        return response()->json(['status' => 'Geofence saved successfully']);
    }

    public function edit(AttendanceLocation $location) {
        return view('attendance.maps-edit', ['location' => $location]);
    }

    public function update(AttendanceLocation $location, Request $request) {    
        $validated = $request->validate([
            'name' => 'required|string',
            'geofence' => 'required|array',
            'geofence.*.lat' => 'required|numeric',
            'geofence.*.lng' => 'required|numeric'
        ]);
    
        $location->update([
            'name' => $validated['name'],
            'geofence' => $validated['geofence']
        ]);
        
        return response()->json(['status' => 'Geofence updated successfully']);
    }
}
