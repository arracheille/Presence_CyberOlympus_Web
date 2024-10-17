<?php

namespace App\Http\Controllers;

use App\Models\TaskitemMember;
use Illuminate\Http\Request;

class TaskitemMemberController extends Controller
{
    public function create(Request $request) {
        $taskitem_members = $request->validate([
            'task_item_id' => 'required|exists:task_items,id',
        ]);
        
        $taskitem_members['user_id'] = auth()->id();
        $taskitem_members['task_item_id'] = $request->task_item_id;

        TaskitemMember::create($taskitem_members);

        return back();
    }

    public function edit(TaskitemMember $taskitem_member) {
        return view('tasks.index', ['assign' => $taskitem_member]);
    }

    public function update(TaskitemMember $taskitem_member, Request $request) {
        $taskitem_members = $request->validate([
            'task_item_id' => 'nullable|exists:task_items,id',
        ]);

        $taskitem_members['task_item_id'] = $request->task_item_id;
        return back()->with('board', $request->board_id);
    }

    public function leave(TaskitemMember $taskitem_member) {
        $taskitem_member->delete();
        return back();
    }
}
