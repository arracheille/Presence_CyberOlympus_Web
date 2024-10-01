<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Checklist extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'check_id',
        'checklist_title',
        'is_checked',
    ];
        
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable('*');
    }

    public function checks() {
        return $this->belongsTo(Check::class, 'check_id');
    }
}
