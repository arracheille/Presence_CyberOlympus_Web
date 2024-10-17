<?php

namespace App\Http\Controllers;

use App\Models\AssignCheck;
use Illuminate\Http\Request;

class AssignCheckController extends Controller
{
    public function create(Request $request) {
        $assign_checks = $request->validate([
            'user_id' => 'required',
            'check_id' => 'required|exists:checks,id',
        ]);
        
        $assign_checks['user_id'] = $request->user_id;
        $assign_checks['check_id'] = $request->check_id;
        AssignCheck::create($assign_checks);

        return back();
    }

    public function edit(AssignCheck $assign_check) {
        return view('tasks.index', ['assign_check' => $assign_check]);
    }

    public function update(AssignCheck $assign_check, Request $request) {
        $assign_checks = $request->validate([
            'user_id' => 'required',
        ]);

        $assign_checks['user_id'] = $request->user_id;
        $assign_check->update($assign_checks);
        return back();
    }

    public function destroy(AssignCheck $assign_check) {
        $assign_check->delete();
        return back();
    }
}
