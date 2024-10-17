<?php

namespace App\Http\Controllers;

use App\Models\DueDate;
use Illuminate\Http\Request;

class DueDateController extends Controller
{
    public function create(Request $request) {
        $due_dates = $request->validate([
            'start_from' => 'required',
            'due_in' => 'required',
            'task_item_id' => 'required|exists:task_items,id',
        ]);

        $due_dates['start_from'] = strip_tags($due_dates['start_from']);
        $due_dates['due_in'] = strip_tags($due_dates['due_in']);
        $due_dates['task_item_id'] = $request->task_item_id;

        DueDate::create($due_dates);

        // return back();
        return back();
    }

}
