<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    public function index() {
        $workspaces = Workspace::all();
        return response()->json($workspaces);
    }

    public function create(Request $request) {
        $workspaces = $request->validate([
            'title'         => 'required',
            'type'          => 'required',
            'description'   => 'nullable',
        ]);

        $workspaces['title']        = strip_tags($workspaces['title']);
        $workspaces['type']         = strip_tags($workspaces['type']);
        $workspaces['description']  = strip_tags($workspaces['description']);
        $workspaces['user_id']      = auth()->id();
        $workspaces['email']        = auth()->user()->email;
        $workspaces['unique_code']  = md5(microtime(true).mt_Rand());
        $workspacesId               = Workspace::create($workspaces);

        $createMember               = new Member();
        $createMember->user_id      = auth()->id();
        $createMember->email        = auth()->user()->email;
        $createMember->role         = 'admin';
        $createMember->workspace_id = $workspacesId->id;
        $createMember->unique_code  = $workspacesId->unique_code;
        $createMember->save();
        
        return response()->json($workspaces);
    }
}
