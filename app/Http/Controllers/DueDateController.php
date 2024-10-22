<?php

namespace App\Http\Controllers;

use App\Models\DueDate;
use App\Models\Schedule;
use App\Models\TaskItem;
use Illuminate\Http\Request;

class DueDateController extends Controller
{
    public function create(Request $request) {
        $due_dates = $request->validate([
            'due_at' => 'required',
            'task_item_id' => 'required|exists:task_items,id',
        ]);

        $due_dates['due_at'] = strip_tags($due_dates['due_at']);
        $due_dates['user_id'] = auth()->user()->id;
        $due_dates['task_item_id'] = $request->task_item_id;
        $due_date = DueDate::create($due_dates);

        $schedules = new Schedule();
        $schedules->user_id = $due_date->user->id;
        $schedules->task_item_id = $due_date->task_item_id;
        $schedules->title = $due_date->taskitems->title;
        $schedules->background_color = 'gradient-blue';
        $schedules->workspace_id = $due_date->taskitems->tasks->board->workspace->id;
        $schedules->start = $due_date->created_at;
        $schedules->end = $due_date->due_at;
        $schedules->save();

        return back();
    }

    public function edit(DueDate $due_date) {
        return view('schedule.edit', ['due_date' => $due_date]);
    }

    public function update(DueDate $due_date, Request $request) {
        $due_dates = $request->validate([
            'due_at' => 'required',
        ]);

        $due_dates['due_at'] = strip_tags($due_dates['due_at']);

        $due_date->update($due_dates);
        return back();
    }

    public function destroy(DueDate $due_date) {
        if ($due_date->trashed()) {
            $due_date->forceDelete();
            return back();
        }

        $due_date->delete();
        return back();
    }
}
