<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function schedule() {
        return $this->belongsTo(Schedule::class, 'schedule_id')->where('deleted_at', NULL);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
