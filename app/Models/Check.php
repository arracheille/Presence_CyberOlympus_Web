<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
class Check extends Model
{
    use HasFactory;
    use LogsActivity;
    use SoftDeletes;

    protected $fillable = [
        'task_item_id',
        'title',
    ];
        
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable('*');
    }

    public function taskitems() {
        return $this->belongsTo(TaskItem::class, 'task_item_id');
    }

    public function checklists() {
        return $this->hasMany(Checklist::class, 'check_id');
    }

    public function assign_checks() {
        return $this->hasMany(AssignCheck::class);
    }
}
