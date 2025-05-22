<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cin',
        'phone',
        'university',
        'department',
        'level',
        'skills',
        'bio',
        'cv_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

