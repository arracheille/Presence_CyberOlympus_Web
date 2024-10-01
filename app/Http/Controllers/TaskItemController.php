<?php

namespace App\Http\Controllers;

use App\Models\TaskItem;
use Illuminate\Http\Request;

class TaskItemController extends Controller
{
    public function create(Request $request) {
        $taskitems = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'title' => 'required',
            'description' => 'nullable',
        ]);
        
        $taskitems['task_id'] = $request->task_id;
        $taskitems['title'] = strip_tags($taskitems['title']);
        $taskitems['description'] = strip_tags($taskitems['description']);
        TaskItem::create($taskitems);

        return back()->with('board', $request->board_id);
    }

    public function edit(TaskItem $taskitem) {
        return view('tasks.index', ['taskitem' => $taskitem]);
    }

    public function update(TaskItem $taskitem, Request $request) {
        $taskitems = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $taskitems['title'] = strip_tags($taskitems['title']);
        $taskitems['description'] = strip_tags($taskitems['description']);
        $taskitem->update($taskitems);
        return back()->with('board', $request->board_id);
    }

    public function destroy(TaskItem $taskitem) {
        $taskitem->delete();
        return back();
    }

    public function updatePosition(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:task_items,id',
            'new_task_id' => 'required|exists:tasks,id',
            'order' => 'required|array',
        ]);
        $taskItem = TaskItem::find($request->item_id);
        $taskItem->task_id = $request->new_task_id;
        $taskItem->save();
        $order = $request->input('order');
        foreach ($order as $item) {
            TaskItem::where('id', $item['id'])->update(['position' => $item['position']]);
        }
        return response()->json(['status' => 'success'], 200);
    }
}
