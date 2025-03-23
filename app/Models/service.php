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
        'room_type',
        'is_available',
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
