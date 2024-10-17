<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
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

    public function attachments() {
        return $this->hasMany(Attachment::class, 'task_item_id');
    }

    public function schedules() {
        return $this->hasMany(Schedule::class, 'task_item_id');
    }

    public function assigns() {
        return $this->hasMany(Assign::class, 'task_item_id');
    }

    public function due_date() {
        return $this->hasMany(DueDate::class, 'task_item_id');
    }

    public function taskitem_members() {
        return $this->hasMany(TaskitemMember::class, 'task_item_id');
    }

    public function logs() {
        return $this->hasMany(LogTaskitem::class, 'task_item_id');
    }

    public function workspaces() {
        return $this->belongsTo(Workspace::class);
    }

    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
                            ->where('task_item_id', $this->id)
                            ->first();
    }
}
