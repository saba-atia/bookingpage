<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    
    protected $table = 'rooms'; // تأكد من أن اسم الجدول صحيح
    protected $fillable = ['name', 'description', 'image']; // تأكد من أن الحقول صحيحة
     

}
