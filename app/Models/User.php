<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function workspaces() {
        return $this->hasMany(Workspace::class, 'user_id');
    }

    public function boards() {
        return $this->hasMany(Board::class, 'user_id');
    }

    public function tasks() {
        return $this->hasMany(Task::class, 'user_id');
    }

    public function schedules() {
        return $this->hasMany(Schedule::class, 'user_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function attendances() {
        return $this->hasMany(Attendance::class);
    }

    public function assigns() {
        return $this->hasMany(Assign::class, 'user_id');
    }

    public function members() {
        return $this->hasMany(Member::class, 'user_id');
    }

    public function taskitem_member() {
        return $this->hasMany(TaskitemMember::class, 'user_id');
    }

    public function assign_check() {
        return $this->hasMany(AssignCheck::class, 'user_id');
    }

    public function assign_checklist() {
        return $this->hasMany(AssignChecklist::class, 'user_id');
    }

    public function logs() {
        return $this->hasMany(LogTaskitem::class, 'user_id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function due_date() {
        return $this->hasMany(DueDate::class, 'user_id');
    }

    public function favorites()
    {
        return $this->belongsToMany(Board::class, 'favorites', 'user_id', 'board_id')->withTimestamps();
    }

    public function favorite_tasks()
    {
        return $this->belongsToMany(Task::class, 'favorite_tasks', 'user_id', 'task_id')->withTimestamps();
    }

    public function favorite_taskitems()
    {
        return $this->belongsToMany(TaskItem::class, 'favorite_taskitems', 'user_id', 'task_item_id')->withTimestamps();
    }
}
