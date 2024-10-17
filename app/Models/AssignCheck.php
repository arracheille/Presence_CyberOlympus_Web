<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'check_id',
    ];
    
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function check() {
        return $this->belongsTo(Check::class, 'check_id');
    }
}
