<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // public function updaterole(Request $request)
    // {
    //     $request->validate([
    //         'role' => 'required',
    //         // 'role' => 'required|in:admin,member',
    //     ]);

    //     $member = Member::findOrFail(auth()->id());
    //     $member->role = $request->role;
    //     $member->save();

    //     return response()->json(['message' => 'Role updated successfully.']);
    // }

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

}
