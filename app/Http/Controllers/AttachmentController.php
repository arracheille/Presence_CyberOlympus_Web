<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    
    public function create(Request $request) {
        $request->validate([
            'task_item_id' => 'required|exists:task_items,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $attachment = new Attachment();
        $attachment->task_item_id = $request->task_item_id;
        $attachment->image = 'images/'.$imageName;
        $attachment->save();

        return back();
    }

    public function edit(Attachment $attachment) {
        return view('tasks.index', ['attachment' => $attachment]);
    }

    public function update(Attachment $attachment, Request $request) {
        $attachments = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            if (file_exists(public_path($attachment->image))) {
                unlink(public_path($attachment->image));
            }
    
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
    
            $attachments['image'] = 'images/'.$imageName;
        }
    
        $attachment->update($attachments);
    
        return back();
    }

    public function destroy(Attachment $attachment) {
        $attachment->delete();
        return back();
    }
}
