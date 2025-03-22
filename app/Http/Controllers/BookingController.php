<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\service;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function index(Request $request)
    {
        $query = Service::query();
        $services = Service::where('is_available', true)->get();
       
        if (auth()->check()) {
            // جلب حجوزات المستخدم الحالي فقط
            $bookings = Booking::where('user_id', auth()->id())->get();
        }
        // البحث
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }
    
        // الفلترة حسب نوع الغرفة
        if ($request->has('room_type')) {
            $query->where('room_type', $request->room_type);
        }
    
        // الترتيب حسب السعر
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        }
    
        $services = $query->get();
        $bookings = [];
    
        if (auth()->check()) {
            $bookings = Booking::where('user_id', auth()->id())->get();
        }
    
        return view('public_site.layouts.bookingpage', compact('services', 'bookings'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'room_type' => 'required|in:single,double,suite',
        ]);
    
        $booking = Booking::create([
            'service_id' => $request->service_id,
            'user_id' => auth()->id(),
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'room_type' => $request->room_type,
            'breakfast' => $request->has('breakfast'),
            'lunch' => $request->has('lunch'),
            'dinner' => $request->has('dinner'),
            'room_service' => $request->has('room_service'),
            'parking' => $request->has('parking'),
            'wifi' => $request->has('wifi'),
            'gym' => $request->has('gym'),
            'pool' => $request->has('pool'),
            'status' => 'pending',
        ]);
    
        return redirect()->route('booking.index')->with('success', 'Booking confirmed!');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('booking.index')->with('success', 'Booking cancelled successfully!');
    }
}