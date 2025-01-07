<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceLocation extends Model
{
    use HasFactory;

    protected $fillable = ['workspace_id', 'geofence', 'name'];

    protected $casts = [
        'geofence' => 'array'
    ];    

    public function workspace() {
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }
}
