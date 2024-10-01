<?php

namespace App\Livewire;

use App\Models\Board;
use Livewire\Component;

class TodoComponent extends Component
{
    public $searchTerm;

    public function render()
    {
        $boards = Board::where('title', 'like', '%'.$this->searchTerm.'%')->get();
        return view('admin.db-todo', ['boards' => $boards]);
    }
}
