<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable=[
        'room_id',
        'name',
        'email',
        'phone',
        'start_date',
        'end_date'


    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id'); // يجب أن يكون الحقل مطابقًا في جدول الحجوزات
    }

}
