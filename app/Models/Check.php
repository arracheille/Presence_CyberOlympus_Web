<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_item_id',
        'title',
    ];

    public function taskitems() {
        return $this->belongsTo(TaskItem::class, 'task_item_id');
    }

    public function checklists() {
        return $this->hasMany(Checklist::class, 'check_id');
    }
}
