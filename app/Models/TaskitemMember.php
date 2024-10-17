<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskitemMember extends Model
{
    use HasFactory;

    protected $fillable = ['task_item_id', 'user_id'];

    public function taskitem() {
        return $this->belongsTo(TaskItem::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
