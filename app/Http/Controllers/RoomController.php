<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all(); // تأكد من أن Room هو اسم الموديل الصحيح

        // تمرير البيانات إلى العرض
        return view('public_site.layouts.roompage', compact('rooms'));
    }
    // تأكد من استيراد المودل

    public function showRooms()
    {
        $rooms = Room::all(); // جلب جميع الغرف من قاعدة البيانات
        return view('public_site.layouts.roompage', compact('rooms')); 
    }
    
    
}
