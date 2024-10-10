<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function create(Request $request) {
        $boards = $request->validate([
            'title' => 'required',
            'workspace_id' => 'required|exists:workspaces,id',
            'background_color' => 'required',
            'visibility' => 'required',
        ]);

        $boards['title'] = strip_tags($boards['title']);
        $tasks['workspace_id'] = $request->workspace_id;
        $boards['background_color'] = strip_tags($boards['background_color']);
        $boards['visibility'] = strip_tags($boards['visibility']);

        $boards['user_id'] = auth()->id();
        Board::create($boards);

        return back()->with('workspace', $request->workspace_id);
    }

    public function edit(Board $board) {
        return view('workspaces.index', ['board' => $board]);
    }

    public function update(Board $board, Request $request) {
        $boards = $request->validate([
            'title' => 'required',
            'background_color' => 'required',
            'visibility' => 'required',
        ]);

        $boards['title'] = strip_tags($boards['title']);
        $boards['background_color'] = strip_tags($boards['background_color']);
        $boards['visibility'] = strip_tags($boards['visibility']);
        $board->update($boards);
        return back();
    }

    public function updatevisibility(Board $board, Request $request) {
        $boards = $request->validate([
            'visibility' => 'required',
        ]);

        $boards['visibility'] = strip_tags($boards['visibility']);
        $board->update($boards);
        return back();
    }

    public function destroy(Board $board) {
        $board->delete();
        return back();
    }

    public function favorite(Board $board)
    {
        Auth::user()->favorites()->attach($board->id);
        return response()->json(['status' => 'favorited']);
    }
    
    public function unfavorite(Board $board)
    {
        Auth::user()->favorites()->detach($board->id);
        return response()->json(['status' => 'unfavorited']);
    }
}
