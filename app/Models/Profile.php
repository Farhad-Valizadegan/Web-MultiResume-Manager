<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'bio',
        'website',
        'linkedin',
        'github',
        'portfolio',
        'xing',
        'profile_photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}