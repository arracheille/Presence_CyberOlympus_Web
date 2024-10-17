<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Workspace extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    protected $fillable = ['title', 'type', 'description', 'user_id', 'unique_code', 'email', 'role'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable('*');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function boards() {
        return $this->hasMany(Board::class);
    }

    public function schedules() {
        return $this->hasMany(Schedule::class);
    }

    public function members() {
        return $this->hasMany(Member::class);
    }

    public function taskitem() {
        return $this->hasMany(taskitem::class);
    }
}
