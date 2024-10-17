<?php

namespace App\Http\Controllers;

use App\Models\AssignChecklist;
use Illuminate\Http\Request;

class AssignChecklistController extends Controller
{
    public function create(Request $request) {
        $assign_checklists = $request->validate([
            'user_id' => 'required',
            'checklist_id' => 'required|exists:checklists,id'
        ]);
        
        $assign_checklists['user_id'] = $request->user_id;
        $assign_checklists['checklist_id'] = $request->checklist_id;
        AssignChecklist::create($assign_checklists);

        return back();
    }

    public function edit(AssignChecklist $assign_checklist) {
        return view('tasks.index', ['assign_checklist' => $assign_checklist]);
    }

    public function update(AssignChecklist $assign_checklist, Request $request) {
        $assign_checklists = $request->validate([
            'user_id' => 'required',
        ]);

        $assign_checklists['user_id'] = $request->user_id;
        $assign_checklist->update($assign_checklists);
        return back();
    }

    public function destroy(AssignChecklist $assign_checklist) {
        $assign_checklist->delete();
        return back();
    }
}
