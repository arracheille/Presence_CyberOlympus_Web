<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignChecklist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'checklist_id',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function checklist() {
        return $this->belongsTo(Checklist::class, 'checklist_id');
    }
}
