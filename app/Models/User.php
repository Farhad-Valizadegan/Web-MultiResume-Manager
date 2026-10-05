<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Each user can have one profile.
     */
    protected static function booted(): void
    {
        static::deleting(function (User $user) {
            foreach ($user->resumes as $resume) {
                $resume->delete();
            }
            app(\App\Services\ResumeFiles::class)->delete($user->profile?->profile_photo, 'public');
        });
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Each user can have many resumes.
     */
    public function resumes()
    {
        return $this->hasMany(Resume::class);
    }
}