<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_item_id', 
        'label', 
        'label_background_color'
    ];

    public function taskitems() {
        return $this->belongsTo(TaskItem::class, 'task_item_id');
    }
}
