<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function create(Request $request) {
        $boards = $request->validate([
            'title' => 'required',
            'background_color' => 'required',
        ]);

        $boards['title'] = strip_tags($boards['title']);
        $boards['background_color'] = strip_tags($boards['background_color']);

        $boards['user_id'] = auth()->id();
        Board::create($boards);

        return redirect('/boards')->with('success', 'Created successfully');
    }

    public function edit(Board $board) {
        return view('boards.edit', ['board' => $board]);
    }

    public function update(Board $board, Request $request) {
        $boards = $request->validate([
            'title' => 'required',
        ]);

        $boards['title'] = strip_tags($boards['title']);
        $board->update($boards);
        return redirect('/boards')->with('success', 'Updated successfully');
    }

    public function destroy(Board $board) {
        $board->delete();
        return redirect('/boards')->with('success', 'Deleted successfully');
    }

    public function sidebar()
    {
        $boards = Board::all();
        return view('layouts.sidebar', compact('boards'));
    }
}
