<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceInfo extends Model
{
    use HasFactory;

    protected $fillable = ['workspace_id', 'min_check_in', 'max_check_in', 'min_check_out', 'max_check_out', 'min_break_in', 'max_break_in', 'min_break_out', 'max_break_out'];

    public function workspace() {
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }
}
