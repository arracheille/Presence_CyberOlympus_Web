<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends Controller
{
    
    public function create(Request $request) {
        $request->validate([
            'task_item_id' => 'required|exists:task_items,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'nullable',
            'link_display' => 'nullable',
        ]);
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $attachments = new Attachment();
            $attachments->task_item_id = $request->task_item_id;
            $attachments->image = 'images/'.$imageName;
        } else {
            $attachments = new Attachment();
            $attachments->task_item_id = $request->task_item_id;
            $attachments->link = $request->link;
            if (empty($request->link_display)) {
                $attachments->link_display = $request->link;
            } else {
                $attachments->link_display = $request->link_display;
            }
        }

        $attachments->save();

        return back();
    }

    public function edit(Attachment $attachment) {
        return view('tasks.index', ['attachment' => $attachment]);
    }

    public function update(Attachment $attachment, Request $request) {
        $attachments = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'link' => 'nullable',
            'link_display' => 'nullable',
        ]);
    
        if ($request->hasFile('image')) {
            if (file_exists(public_path($attachment->image))) {
                unlink(public_path($attachment->image));
            }
    
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);
    
            $attachments['image'] = 'images/'.$imageName;
        } elseif ($request->filled('link')) {
            $attachments['link'] = $request->link;
            // $attachments['link_display'] = $request->link_display;
            if (empty($request->link_display)) {
                $attachments['link_display'] = $request->link;
            } else {
                $attachments['link_display'] = $request->link_display;
            }
        }
    
        $attachment->update($attachments);
    
        return back();
    }

    public function destroy(Attachment $attachment) {
        $attachment->delete();
        return back();
    }
}
