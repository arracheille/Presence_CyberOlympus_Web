<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = ['title', 'user_id', 'board_id', 'position', 'background_color'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable('*');
    }

    public function board() {
        return $this->belongsTo(Board::class, 'board_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function taskitems() {
        return $this->hasMany(TaskItem::class, 'task_id')->orderBy('position', 'asc');
    }

    public function assigns() {
        return $this->hasMany(Assign::class, 'task_id');
    }

    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
                                ->where('task_id', $this->id)
                                ->first();
    }
}
