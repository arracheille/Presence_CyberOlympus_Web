<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request) {
        $tasks = $request->validate([
            'title' => 'required',
            'board_id' => 'required|exists:boards,id',
            'background_color' => 'required',
        ]);
        
        $tasks['title'] = strip_tags($tasks['title']);
        $tasks['board_id'] = $request->board_id;
        $tasks['background_color'] = strip_tags($tasks['background_color']);
        $tasks['user_id'] = auth()->id();
        Task::create($tasks);

        return back()->with('board', $request->board_id);
    }

    public function edit(Task $task) {
        return view('tasks.index', ['task' => $task]);
    }

    public function update(Task $task, Request $request) {
        $tasks = $request->validate([
            'title' => 'required',
            'background_color' => 'required',
        ]);

        $tasks['title'] = strip_tags($tasks['title']);
        $tasks['background_color'] = strip_tags($tasks['background_color']);
        $task->update($tasks);
        return back()->with('board', $request->board_id);
    }

    public function destroy(Task $task) {
        $task->delete();
        return back();
    }

    public function updateOrder(Request $request)
    {
        $order = $request->input('order');
        
        foreach ($order as $item) {
            Task::where('id', $item['id'])->update(['position' => $item['position']]);
        }

        return response()->json(['status' => 'success']);
    }

    // public function create(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'board_id' => 'required|exists:boards,id',
    //         'background_color' => 'required|string',
    //     ]);
    
    //     $validatedData['title'] = strip_tags($validatedData['title']);
    //     $validatedData['background_color'] = strip_tags($validatedData['background_color']);
    //     $validatedData['user_id'] = auth()->id();
    
    //     $task = Task::create($validatedData);
    
    //     return response()->json([
    //         'task' => [
    //             'id' => $task->id,
    //             'title' => $task->title,
    //             'background_color' => $task->background_color,
    //             'user_name' => $task->user->name,
    //         ]
    //     ]);
    // }
}