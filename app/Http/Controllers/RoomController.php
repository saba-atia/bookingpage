<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function show($id) {
        $room = Room::findOrFail($id); // جلب بيانات الغرفة من قاعدة البيانات
        return view('public_site.layouts.room_details', compact('room')); // إرسال البيانات إلى صفحة التفاصيل
    }
}
