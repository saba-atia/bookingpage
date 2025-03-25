<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomBookingController extends Controller
{
    public function create($id) {
        $room = Room::findOrFail($id);
        return view('public_site.layouts.booking_form', compact('room'));
    }

    public function store(Request $request)
    {
        // التحقق من البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'payment_method' => 'required|string',
        ]);
    
        // تخزين البيانات في قاعدة البيانات
        $booking = new Booking();
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->payment_method = $request->payment_method;
        $booking->room_id = $request->room_id;
        $booking->save();
    
        return redirect()->route('booking.index')->with('success', 'Your room has been booked successfully!');
    }
    
    

}
