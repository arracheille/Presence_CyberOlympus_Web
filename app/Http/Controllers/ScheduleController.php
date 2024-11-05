<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function create(Request $request) {
        $schedules = $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'background_color' => 'required',
            // 'task_item_id' => 'nullable|exists:task_items,id',
            'workspace_id' => 'required|exists:workspaces,id',
        ]);

        $schedules['title'] = strip_tags($schedules['title']);
        $schedules['start'] = strip_tags($schedules['start']);
        $schedules['end'] = strip_tags($schedules['end']);
        $schedules['background_color'] = strip_tags($schedules['background_color']);
        // $schedules['task_item_id'] = $request->task_item_id;
        $schedules['workspace_id'] = $request->workspace_id;
        $schedules['user_id'] = auth()->id();

        $events[] = array(
            'title' => $schedules['title'],
            'start'=> $schedules['start'],
            'end'=> $schedules['end'],
            'background_color' => $schedules['background_color'],
        );
        
        Schedule::create($schedules);
        
        return back();
    }

    public function edit(Schedule $schedule) {
        return view('schedule.edit', ['schedule' => $schedule]);
    }

    public function update(Schedule $schedule, Request $request) {
        $schedules = $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'background_color' => 'required',
        ]);

        $schedules['title'] = strip_tags($schedules['title']);        
        $schedules['start'] = strip_tags($schedules['start']);
        $schedules['end'] = strip_tags($schedules['end']);
        $schedules['background_color'] = strip_tags($schedules['background_color']);

        $schedule->update($schedules);
        return back();
        // return redirect('/schedule')->with('success', 'Updated successfully');
    }

    public function destroy(Schedule $schedule) {
        if ($schedule->trashed()) {
            $schedule->forceDelete();
            return back();
        }

        $schedule->delete();
        return back();
    }

    public function restore(Schedule $schedule) {
        $schedule->restore();
        return back();
    }

    public function read(Request $request)
    {
        $dataChecklist = Notification::find($request->schedule_id);

        if ($dataChecklist) {
            $dataChecklist->read_at += 1;
            $dataChecklist->save();

            return response()->json([
                'message'     => 'Berhasil simpan',
                'read_at'  => $request->read_at
            ]);

        } else {
            return response()->json([
                'message' => 'Gagal simpan'
            ]);
        }
    }
    
    // public function create_due(Request $request) {
    //     $schedules = $request->validate([
    //         'title' => 'required',
    //         'start' => 'required',
    //         'end' => 'required',
    //         'task_item_id' => 'required|exists:task_items,id',
    //         'workspace_id' => 'required|exists:workspaces,id',
    //         'background_color' => 'required',
    //     ]);

    //     $schedules['title'] = strip_tags($schedules['title']);
    //     $schedules['start'] = strip_tags($schedules['start']);
    //     $schedules['end'] = strip_tags($schedules['end']);
    //     $schedules['task_item_id'] = $request->task_item_id;
    //     $schedules['workspace_id'] = $request->workspace_id;
    //     $schedules['background_color'] = strip_tags($schedules['background_color']);

    //     $schedules['user_id'] = auth()->id();

    //     Schedule::create($schedules);

    //     // return back();
    //     return back();
    // }
}
