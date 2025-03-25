<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'phone', 

    ];

    protected $hidden = [
        'password',
    ];

    protected $table = 'admins';

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
