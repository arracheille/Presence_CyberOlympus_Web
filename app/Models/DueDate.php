<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DueDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_item_id',
        'due_at',
    ];

    public function taskitems() {
        return $this->belongsTo(TaskItem::class, 'task_item_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
