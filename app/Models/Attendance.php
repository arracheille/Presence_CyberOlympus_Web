<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Attendance extends Model
{
    use HasFactory;
    // use LogsActivity;

    protected $fillable = ['status', 'user_id', 'workspace_id', 'attendance_at'];

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //     ->logFillable('*');
    // }

    public function workspace() {
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
