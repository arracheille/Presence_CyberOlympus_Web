<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class TaskItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;


    protected $fillable = [
        'task_id',
        'title',
        'description',
        'position'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable('*');
    }


    public function tasks() {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function labels() {
        return $this->hasMany(Label::class, 'task_item_id');
    }

    public function covers() {
        return $this->hasMany(Cover::class, 'task_item_id');
    }

    public function checks() {
        return $this->hasMany(Check::class, 'task_item_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'task_item_id');
    }
}
