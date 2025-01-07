<?php

namespace App\Http\Controllers;

use App\Models\AttendanceInfo;
use Illuminate\Http\Request;

class AttendanceInfoController extends Controller
{
    public function create(Request $request) {
        $infos = $request->validate([
            'workspace_id'  => 'required|exists:workspaces,id',
            'min_check_in'  => 'required',
            'max_check_in'  => 'required',
            'min_check_out' => 'required',
            'max_check_out' => 'required',
            'min_break_in'  => 'required',
            'max_break_in'  => 'required',
            'min_break_out' => 'required',
            'max_break_out' => 'required',
        ]);

        AttendanceInfo::create([
            'min_check_in'  => $infos['min_check_in'],
            'max_check_in'  => $infos['max_check_in'],
            'min_check_out' => $infos['min_check_out'],
            'max_check_out' => $infos['max_check_out'],
            'min_break_in'  => $infos['min_break_in'],
            'max_break_in'  => $infos['max_break_in'],
            'min_break_out' => $infos['min_break_out'],
            'max_break_out' => $infos['max_break_out'],
            'workspace_id'  => $infos['workspace_id'],
        ]);
    
        return redirect()->back()->with('workspace', $request->workspace_id);
    }

    public function edit(AttendanceInfo $info) {
        return view('attendance', ['info' => $info]);
    }

    public function update(AttendanceInfo $info, Request $request) {
        $infos = $request->validate([
            'min_check_in'  => 'required',
            'max_check_in'  => 'required',
            'min_check_out' => 'required',
            'max_check_out' => 'required',
            'min_break_in'  => 'required',
            'max_break_in'  => 'required',
            'min_break_out' => 'required',
            'max_break_out' => 'required',
        ]);

        $infos['min_check_in']  = strip_tags($infos['min_check_in']);
        $infos['max_check_in']  = strip_tags($infos['max_check_in']);
        $infos['min_check_out'] = strip_tags($infos['min_check_out']);
        $infos['max_check_out'] = strip_tags($infos['max_check_out']);
        $infos['min_break_in']  = strip_tags($infos['min_break_in']);
        $infos['max_break_in']  = strip_tags($infos['max_break_in']);
        $infos['min_break_out'] = strip_tags($infos['min_break_out']);
        $infos['max_break_out'] = strip_tags($infos['max_break_out']);
        
        $info->update($infos);
        
        return redirect()->back()->with('workspace', $request->workspace_id);
    }
}
