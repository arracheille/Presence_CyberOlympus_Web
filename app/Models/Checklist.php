<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;


    protected $fillable = [
        'check_id',
        'checklist_title',
        'is_checked',
    ];

    public function checks() {
        return $this->belongsTo(Check::class, 'check_id');
    }
}
