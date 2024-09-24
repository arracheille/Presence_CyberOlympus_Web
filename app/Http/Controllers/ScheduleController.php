<?php

namespace App\Http\Controllers;

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
        ]);

        $schedules['title'] = strip_tags($schedules['title']);
        $schedules['start'] = strip_tags($schedules['start']);
        $schedules['end'] = strip_tags($schedules['end']);
        $schedules['background_color'] = strip_tags($schedules['background_color']);

        $events[] = array(
            'title' => $schedules['title'],
            'start'=> $schedules['start'],
            'end'=> $schedules['end'],
            'background_color' => $schedules['background_color'],
        );

        $schedules['user_id'] = auth()->id();
        Schedule::create($schedules);

        return redirect('/schedule')->with('success', 'Created successfully');
    }

    public function create_due(Request $request) {
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

        $schedules['user_id'] = auth()->id();
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
        return redirect('/schedule')->with('success', 'Updated successfully');
    }

    public function destroy(Schedule $schedule) {
        $schedule->delete();
        return redirect('/schedule')->with('success', 'Deleted successfully');
    }
}
