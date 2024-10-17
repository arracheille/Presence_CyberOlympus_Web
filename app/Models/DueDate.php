<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DueDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_from',
        'due_in'
    ];

    public function taskitem() {
        return $this->belongsTo(TaskItem::class, 'task_item_id');
    }
}
