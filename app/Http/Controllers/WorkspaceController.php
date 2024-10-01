<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
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
        $workspaces['unique_code'] = md5(microtime(true).mt_Rand());
        $workspacesId = Workspace::create($workspaces);

        $createMember               = new Member();
        $createMember->user_id      = auth()->id();
        $createMember->workspace_id  = $workspacesId->id;
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
        $workspace->delete();
        return redirect('/workspace');
    }
}
