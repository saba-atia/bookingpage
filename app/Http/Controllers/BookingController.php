<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        // جلب الخدمات المتاحة مع تطبيق الفلترة والترتيب
        $query = Service::where('is_available', true);

        // البحث
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // الفلترة حسب نوع الغرفة
        if ($request->has('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        // الترتيب حسب السعر
        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        }

        // جلب النتائج
        $services = $query->get();

        // جلب حجوزات المستخدم الحالي
        $bookings = [];
        if (auth()->check()) {
            $bookings = Booking::where('user_id', auth()->id())->get();
        }

        // إذا كان هناك roomId، جلب تفاصيل الغرفة
        $roomId = $request->room_id; // افترض أن room_id يتم تمريره عبر الطلب
        if ($roomId) {
            $room = Room::findOrFail($roomId); // جلب تفاصيل الغرفة المحددة
            return view('public_site.layouts.bookingpage', compact('room', 'services', 'bookings'));
        }

        // إرجاع العرض بدون تفاصيل الغرفة
        return view('public_site.layouts.bookingpage', compact('services', 'bookings'));
    }

    public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('public_site.layouts.bookingpage', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'payment_method' => 'required|in:credit_card,paypal,cash', // التحقق من طريقة الدفع
        ]);
    
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->room_id = $request->room_id;
        $booking->booking_date = $request->booking_date;
        $booking->booking_time = $request->booking_time;
        $booking->payment_method = $request->payment_method; // حفظ طريقة الدفع
        $booking->status = 'pending'; // حالة الحجز
        $booking->save();
    
        return redirect()->route('booking.index')->with('success', 'Booking confirmed successfully!');
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);

        if (auth()->id() !== $booking->user_id) {
            return redirect()->route('booking.index')->with('error', 'You are not authorized to cancel this booking.');
        }

        $booking->update(['status' => 'cancelled']);
        return redirect()->route('booking.index')->with('success', 'Booking cancelled successfully!');
    }
}