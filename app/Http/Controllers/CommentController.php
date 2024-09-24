<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request) {
        $comments = $request->validate([
            'task_item_id' => 'required|exists:task_items,id',
            'comment' => 'required',
        ]);
        
        $comments['task_item_id'] = $request->task_item_id;
        $comments['comment'] = strip_tags($comments['comment']);
        $comments['user_id'] = auth()->id();
        Comment::create($comments);

        return back();
    }

    public function edit(Comment $comment) {
        return view('tasks.index', ['comment' => $comment]);
    }

    public function update(Comment $comment, Request $request) {
        $comments = $request->validate([
            'comment' => 'required',
        ]);

        $comments['comment'] = strip_tags($comments['comment']);
        $comment->update($comments);
        return back();
    }

    public function destroy(Comment $task) {
        $task->delete();
        return back();
    }
}
