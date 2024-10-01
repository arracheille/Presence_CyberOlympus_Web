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

    public function member() {
        return $this->hasMany(Member::class, 'user_id');
    }
}
