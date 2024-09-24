<?php

namespace App\Http\Controllers;

use App\Models\Label;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function create(Request $request) {
        $labels = $request->validate([
            'task_item_id' => 'required|exists:task_items,id',
            'label' => 'required',
            'label_background_color' => 'required',
        ]);

        $labels['task_item_id'] = $request->task_item_id;
        $labels['label'] = strip_tags($labels['label']);
        $labels['label_background_color'] = strip_tags($labels['label_background_color']);

        Label::create($labels);

        return back();
    }

    public function edit(Label $label) {
        return view('tasks.index', ['label' => $label]);
    }

    public function update(Label $label, Request $request) {
        $labels = $request->validate([
            'label' => 'required',
            'label_background_color' => 'required',
        ]);

        $labels['label'] = strip_tags($labels['label']);
        $labels['label_background_color'] = strip_tags($labels['label_background_color']);
        $label->update($labels);
        return back()->with('board', $request->board_id);
    }

    public function destroy(Label $label) {
        $label->delete();
        return back();
    }
}
