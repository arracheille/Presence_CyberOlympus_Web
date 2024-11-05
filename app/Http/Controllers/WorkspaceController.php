<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index() {
        $workspaces = Workspace::latest()->paginate(5);
        return response()->json($workspaces);
    }

    public function create_workspace(Request $request) {
        $workspaces = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'description' => 'nullable',
        ]);

        $workspaces['title'] = strip_tags($workspaces['title']);
        $workspaces['type'] = strip_tags($workspaces['type']);
        $workspaces['description'] = strip_tags($workspaces['description']);
        $workspaces['user_id'] = auth()->id();
        $workspaces['email'] = auth()->user()->email;
        $workspaces['unique_code'] = md5(microtime(true).mt_Rand());
        $workspacesId = Workspace::create($workspaces);

        $createMember               = new Member();
        $createMember->user_id      = auth()->id();
        $createMember->email        = auth()->user()->email;
        $createMember->role         = 'admin';
        $createMember->workspace_id = $workspacesId->id;
        $createMember->unique_code  = $workspacesId->unique_code;
        $createMember->save();
        
        return redirect('/workspace');
    }

    public function create(Request $request) {
        $workspaces = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'description' => 'nullable',
        ]);

        $workspaces['title'] = strip_tags($workspaces['title']);
        $workspaces['type'] = strip_tags($workspaces['type']);
        $workspaces['description'] = strip_tags($workspaces['description']);
        $workspaces['user_id'] = auth()->id();
        $workspaces['email'] = auth()->user()->email;
        $workspaces['unique_code'] = md5(microtime(true).mt_Rand());
        $workspacesId = Workspace::create($workspaces);

        $createMember               = new Member();
        $createMember->user_id      = auth()->id();
        $createMember->email        = auth()->user()->email;
        $createMember->role         = 'admin';
        $createMember->workspace_id = $workspacesId->id;
        $createMember->unique_code  = $workspacesId->unique_code;
        $createMember->save();
        
        return redirect('/workspace');
    }

    public function edit(Workspace $workspace) {
        return view('workspaces.index', ['workspace' => $workspace]);
    }

    public function update(Workspace $workspace, Request $request) {
        $workspaces = $request->validate([
            'title' => 'required',
            'type' => 'required',
            'description' => 'nullable',
        ]);

        $workspaces['title'] = strip_tags($workspaces['title']);        
        $workspaces['type'] = strip_tags($workspaces['type']);
        $workspaces['description'] = strip_tags($workspaces['description']);
        $workspace->update($workspaces);
        return redirect('/workspace');
    }

    public function destroy(Workspace $workspace) {
        if ($workspace->trashed()) {
            $workspace->forceDelete();
            return back();
        }

        $workspace->members()->delete();
        $workspace->delete();
        return view('workspaces.index');
    }
    
    public function restore(Workspace $workspace, Request $request) {
        $workspace->restore();
        $insertMember               = new Member;
        $insertMember->user_id      = auth()->user()->id;
        $insertMember->email        = auth()->user()->email;
        $insertMember->role         = 'admin';
        $insertMember->workspace_id = $request->id;
        $insertMember->unique_code  = $request->unique_code;
        $insertMember->save();
        
        return back();
    }
}
