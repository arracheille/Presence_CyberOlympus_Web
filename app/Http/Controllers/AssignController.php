<?php

namespace App\Http\Controllers;

use App\Models\Assign;
use Illuminate\Http\Request;

class AssignController extends Controller
{
    public function create(Request $request) {
        $assigns = $request->validate([
            'task_id' => 'nullable|exists:tasks,id',
            'task_item_id' => 'nullable|exists:task_items,id',
            'user' => 'required',
        ]);
        
        $assigns['user'] = strip_tags($assigns['user']);
        $assigns['task_id'] = $request->task_id;
        $assigns['task_item_id'] = $request->task_item_id;
        Assign::create($assigns);

        return back()->with('board', $request->board_id);
    }

    public function edit(Assign $assign) {
        return view('tasks.index', ['assign' => $assign]);
    }

    public function update(Assign $assign, Request $request) {
        $assigns = $request->validate([
            'title' => 'required',
            'background_color' => 'required',
        ]);

        $assigns['title'] = strip_tags($assigns['title']);
        $assigns['background_color'] = strip_tags($assigns['background_color']);
        $assign->update($assigns);
        return back()->with('board', $request->board_id);
    }

    public function destroy(Assign $assign) {
        $assign->delete();
        return back();
    }
}
