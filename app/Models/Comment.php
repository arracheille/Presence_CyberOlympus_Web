<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_item_id',
        'user_id',
        'comment',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function taskitems() {
        return $this->belongsTo(TaskItem::class, 'task_item_id');
    }
}
