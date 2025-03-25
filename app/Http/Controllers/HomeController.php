<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function rooms()
{
    $rooms = Room::all(); // جلب جميع الغرف من قاعدة البيانات
    return view('public_site.layouts.roompage', compact('rooms'));
}
    public function room_details($id)
    {
        $room = Room::findOrFail($id);
        return view('public_site.layouts.room_details', compact('room'));
    }

    public function add_booking(Request $request, $id)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // التحقق من توفر الغرفة في التواريخ المحددة
        $isBooked = Booking::where('room_id', $id)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('start_date', [$startDate, $endDate])
                    ->orWhereBetween('end_date', [$startDate, $endDate]);
            })->exists();

        if ($isBooked) {
            return redirect()->back()->with('message', 'Room is already booked for these dates. Please choose a different date.');
        }

        // إنشاء حجز جديد
        $booking = new Booking();
        $booking->room_id = $id;
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->start_date = $startDate;
        $booking->end_date = $endDate;
        $booking->save();

        return redirect()->back()->with('message', 'Room booked successfully.');
    }
}
