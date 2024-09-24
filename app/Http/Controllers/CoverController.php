<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    public function create(Request $request) {
        $covers = $request->validate([
            'task_item_id' => 'required|exists:task_items,id',
            'background_color' => 'required',
        ]);

        $covers['task_item_id'] = $request->task_item_id;
        $covers['background_color'] = strip_tags($covers['background_color']);

        Cover::create($covers);

        return back();
    }

    public function edit(Cover $cover) {
        return view('tasks.index', ['taskitem' => $cover]);
    }

    public function update(Cover $cover, Request $request) {
        $covers = $request->validate([
            'background_color' => 'required',
        ]);

        $covers['background_color'] = strip_tags($covers['background_color']);
        $cover->update($covers);
        return back()->with('board', $request->board_id);
    }

    public function destroy(Cover $cover) {
        $cover->delete();
        return back();
    }
}
