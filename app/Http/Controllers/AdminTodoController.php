<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class AdminTodoController extends Controller
{
    public function index() {
        $boards = Board::all();
        return view('admin.db-todo', ['boards' => $boards]);
    }
}
