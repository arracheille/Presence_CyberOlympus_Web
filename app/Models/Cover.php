<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cover extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_item_id', 
        'background_color',
        'background_image'
    ];

    public function taskitems() {
        return $this->belongsTo(TaskItem::class, 'task_item_id');
    }

}
