<?php

namespace App\Http\Controllers;

use App\Models\Check;
use Illuminate\Http\Request;

class CheckController extends Controller
{
    public function create(Request $request) {
        $checks = $request->validate([
            'task_item_id' => 'required|exists:task_items,id',
            'title' => 'required',
        ]);

        $checks['task_item_id'] = $request->task_item_id;
        $checks['title'] = strip_tags($checks['title']);

        Check::create($checks);

        return back();
    }

    public function edit(Check $check) {
        return view('tasks.index', ['check' => $check]);
    }

    public function update(Check $check, Request $request) {
        $checks = $request->validate([
            'title' => 'required',
        ]);

        $checks['title'] = strip_tags($checks['title']);
        $check->update($checks);
        return back()->with('board', $request->board_id);
    }

    public function destroy(Check $check) {
        $check->delete();
        return back();
    }
}
