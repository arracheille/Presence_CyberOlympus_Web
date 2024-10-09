<?php

namespace App\Http\Controllers;

use App\Models\Cover;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    public function create(Request $request) {
        $covers = $request->validate([
            'task_item_id' => 'required|exists:task_items,id',
            'background_color' => 'nullable',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        // $covers['background_color'] = strip_tags($covers['background_color']);

        if ($request->hasFile('background_image')) {
            $imageName = time().'.'.$request->background_image->extension();
            $request->background_image->move(public_path('background_images'), $imageName);
            $covers = new Cover();
            $covers->task_item_id = $request->task_item_id;
            $covers->background_image = 'background_images/'.$imageName;
        } else {
            $covers = new Cover();
            $covers->task_item_id = $request->task_item_id;
            $covers->background_color = $request->background_color;
        }

        $covers->save();
        return back();
    }

    public function edit(Cover $cover) {
        return view('tasks.index', ['cover' => $cover]);
    }

    public function update(Cover $cover, Request $request) {
        $covers = $request->validate([
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'background_color' => 'nullable',
        ]);
        
        if ($request->hasFile('background_image')) {
            if ($cover->background_image && file_exists(public_path($cover->background_image))) {
                // dd(public_path($cover->background_image));
                unlink(public_path($cover->background_image)); // Hapus file lama
            }        
    
            $imageName = time().'.'.$request->background_image->extension();
            $request->background_image->move(public_path('background_images'), $imageName);
    
            $covers['background_image'] = 'background_images/'.$imageName;
        } elseif ($request->filled('background_color')) {
            $covers['background_color'] = $request->background_color;
        }
        
        $cover->update($covers);

        return back()->with('board', $request->board_id);
    }

    public function destroy(Cover $cover) {
        $cover->delete();
        return back();
    }
}
