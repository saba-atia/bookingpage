<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_available',
        'room_type',
        'breakfast',
        'lunch',
        'dinner',
        'room_service',
        'parking',
        'wifi',
        'gym',
        'pool',
    ];
    
    public function bookings()
{
    return $this->hasMany(Booking::class);
}
}
