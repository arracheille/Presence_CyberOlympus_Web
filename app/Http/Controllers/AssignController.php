<?php

namespace App\Http\Controllers;

use App\Mail\AssignMail;
use App\Models\Assign;
use App\Models\Board;
use App\Models\TaskItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AssignController extends Controller
{
    public function create(Request $request) {
        $assigns = $request->validate([
            'task_id'       => 'nullable|exists:tasks,id',
            'task_item_id'  => 'nullable|exists:task_items,id',
            'user'          => 'required',
        ]);
        
        $assigns['user']            = strip_tags($assigns['user']);
        $assigns['task_id']         = $request->task_id;
        $assigns['task_item_id']    = $request->task_item_id;
        Assign::create($assigns);

        $mailUser = User::where('name', $assigns['user'])->first();

        $findTaskItem = TaskItem::find($request->task_item_id);    

        if ($findTaskItem && $findTaskItem->tasks) {
            $findBoard = $findTaskItem->tasks->board;
            $findWorkspace = $findBoard->workspace;
    
            if ($findWorkspace) {
                // $mailUser = $assigns['user'];
                // Mail::to($mailUser)->send(new AssignMail($findBoard, $findWorkspace, $findTaskItem));
                $user = User::where('name', $assigns['user'])->first();
            
                if ($user && $user->email) {
                    $mailUser = $user->email;
                    Mail::to($mailUser)->send(new AssignMail($findBoard, $findWorkspace, $findTaskItem));
                }    
            }
        }

        // $mailUser = User::where('name', $assigns['user'])->first();
    
        // if ($mailUser) {
        //     $findBoard       = Task::find($request->task_id);
        //     $findWorkspace   = Workspace::find($findBoard->workspace_id);
            
        //     Mail::to($mailUser->email)->send(new AssignMail($findBoard, $findWorkspace));
        // }

        // $mailUser        = 
        // $findBoard       =
        // $findWorkspace   =
        // Mail::to($mailUser)->send(new AssignMail($findBoard, $findWorkspace));

        return back()->with('board', $request->board_id);
    }

    public function edit(Assign $assign) {
        return view('tasks.index', ['assign' => $assign]);
    }

    public function update(Assign $assign, Request $request) {
        $assigns = $request->validate([
            'title'             => 'required',
            'background_color'  => 'required',
        ]);

        $assigns['title']               = strip_tags($assigns['title']);
        $assigns['background_color']    = strip_tags($assigns['background_color']);

        $assign->update($assigns);

        return back()->with('board', $request->board_id);
    }

    public function destroy(Assign $assign) {
        $assign->delete();
        return back();
    }
}
