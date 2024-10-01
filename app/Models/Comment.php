<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Comment extends Model
{
    use HasFactory;
        use LogsActivity;

    protected $fillable = [
        'task_item_id',
        'user_id',
        'comment',
    ];
            
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable('*');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function taskitems() {
        return $this->belongsTo(TaskItem::class, 'task_item_id');
    }
}
