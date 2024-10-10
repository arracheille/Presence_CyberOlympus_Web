<?php

namespace App\Http\Controllers;

use App\Models\TaskItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskItemController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'title' => 'required|string|max:255',
        ]);
    
        $lastPosition = TaskItem::where('task_id', $request->task_id)->max('position');
    
        $taskItem = new TaskItem();
        $taskItem->task_id = $request->task_id;
        $taskItem->title = $request->title;
        $taskItem->position = is_null($lastPosition) ? 0 : $lastPosition + 1;
        $taskItem->save();
        
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

        foreach ($request->order as $item) {
            $position = isset($item['position']) ? $item['position'] : 0;
            TaskItem::where('id', $item['id'])->update(['position' => $position]);
        }
        
        return response()->json(['status' => 'success'], 200);
    }

    public function favorite(TaskItem $taskitem)
    {
        Auth::user()->favorite_taskitems()->attach($taskitem->id);
        return response()->json(['status' => 'favorited']);
    }
    
    public function unfavorite(TaskItem $taskitem)
    {
        Auth::user()->favorite_taskitems()->detach($taskitem->id);
        return response()->json(['status' => 'unfavorited']);
    }
}
