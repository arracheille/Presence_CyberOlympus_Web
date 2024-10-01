<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Schedule extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'title', 
        'start', 
        'end',
        'user_id',
        'task_item_id',
        'workspace_id',
        'background_color'
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable('*');
    }

    public function workspace() {
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function taskitems() {
        return $this->belongsTo(TaskItem::class, 'task_item_id');
    }
}
