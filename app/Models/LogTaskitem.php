<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTaskitem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'task_item_id',
        'label_id',
        'schedule_id',
        'assign_id',
        'taskitem_member_id',
        'cover_id',
        'check_id',
        'checklist_id',
        'attachment_id',
        'comment_id',
        'assign_check_id',
        'assign_checklist_id',
        'action',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function taskitem() {
        return $this->belongsTo(Task::class, 'task_item_id');
    }

    public function labels() {
        return $this->belongsTo(Label::class, 'label_id');
    }

    public function covers() {
        return $this->belongsTo(Cover::class, 'cover_id');
    }

    public function checks() {
        return $this->belongsTo(Check::class, 'check_id');
    }

    public function checklists() {
        return $this->belongsTo(Checklist::class, 'checklist_id');
    }

    public function comments() {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function attachments() {
        return $this->belongsTo(Attachment::class, 'attachment_id');
    }

    public function schedules() {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }

    public function assigns() {
        return $this->belongsTo(Assign::class, 'assign_id');
    }

    public function taskitem_members() {
        return $this->belongsTo(TaskitemMember::class, 'taskitem_member_id');
    }

    public function assign_checks() {
        return $this->belongsTo(AssignCheck::class, 'assign_check_id');
    }

    public function assign_checklists() {
        return $this->belongsTo(AssignChecklist::class, 'assign_checklist_id');
    }
}
