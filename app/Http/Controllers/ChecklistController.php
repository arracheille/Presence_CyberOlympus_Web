<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function create(Request $request) {
        $checklists = $request->validate([
            'check_id' => 'required|exists:checks,id',
            'checklist_title' => 'required|string|max:255',
            'is_checked' => 'nullable|boolean',
        ]);
    
        $checklists['checklist_title'] = strip_tags($checklists['checklist_title']);
        $checklists['is_checked'] = $request->is_checked ?? false;
    
        Checklist::create($checklists);
    
        return back();
    }
    
    public function edit(Checklist $checklist) {
        return view('tasks.index', ['checklist' => $checklist]);
    }

    // public function update(Checklist $checklist, Request $request) {
    //     $dataChecklist = Checklist::find($request->check_id);

    //     if ($dataChecklist) {
    //         $dataChecklist->is_checked = $request->is_checked;
    //         $dataChecklist->save();

    //         return response()->json([
    //            'message'     => 'Berhasil simpan',
    //            'is_checked'  => $request->is_checked
    //         ]);

    //     } else {
    //         return response()->json([
    //           'message' => 'Gagal simpan'
    //         ]);
    //     }
    // }

    public function update(Checklist $checklist, Request $request) {
        $dataChecklist = Checklist::find($request->check_id);
    
        if ($dataChecklist) {
            $dataChecklist->is_checked = $request->is_checked;
            $dataChecklist->save();
    
            $checkedCount = Checklist::where('check_id', $dataChecklist->check_id)
                                    ->where('is_checked', true)
                                    ->count();
            $totalChecklists = Checklist::where('check_id', $dataChecklist->check_id)
                                        ->count();
    
            return response()->json([
               'message' => 'Berhasil simpan',
               'is_checked' => $request->is_checked,
               'checkedCount' => $checkedCount,
               'totalChecklists' => $totalChecklists
            ]);
    
        } else {
            return response()->json([
              'message' => 'Gagal simpan'
            ]);
        }
    }
    

    public function destroy(Checklist $checklist) {
        $checklist->delete();
        return back();
    }    

            // $checklists = $request->validate([
        //     'checklist_title' => 'required|string|max:255',
        //     'is_checked' => 'required|boolean',
        // ]);
        
        // $checklists['checklist_title'] = strip_tags($checklists['checklist_title']);
        // $checklists['is_checked'] = $request->is_checked;
        
        // $checklist->update($checklists);

        // return back()->with('board', $request->board_id);
}
