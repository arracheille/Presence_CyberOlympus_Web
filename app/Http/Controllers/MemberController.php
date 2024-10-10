<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Workspace;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function edit(Member $member) {
        return view('workspaces.member-detail', ['member' => $member]);
    }

    public function update(Member $member, Request $request) {
        $members = $request->validate([
            'role' => 'required',
        ]);

        $members['role'] = strip_tags($members['role']);
        $member->update($members);
        return back();
    }

    public function kick(Member $member, Request $request) {
        $workspaceId = $request->input('workspace_id');
        $member->delete();
        return redirect()->to('/workspace/'.$workspaceId.'/members');
    }

    public function leave(Member $member) {
        $member->delete();
        return redirect()->to('/workspace');
    }
}
