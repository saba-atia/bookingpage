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
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'services' => 'nullable|array',
        ]);
    
        // حساب السعر الإجمالي
        $room = Room::find($request->room_id);
        $totalPrice = $room->price;
    
        if ($request->has('services')) {
            foreach ($request->services as $service) {
                switch ($service) {
                    case 'breakfast':
                        $totalPrice += 10;
                        break;
                    case 'lunch':
                        $totalPrice += 15;
                        break;
                    case 'dinner':
                        $totalPrice += 20;
                        break;
                    case 'room_service':
                        $totalPrice += 25;
                        break;
                    case 'parking':
                        $totalPrice += 5;
                        break;
                    case 'gym':
                        $totalPrice += 10;
                        break;
                    case 'pool':
                        $totalPrice += 10;
                        break;
                }
            }
        }
    
        // حفظ الحجز في قاعدة البيانات
        $booking = new Booking();
        $booking->user_id = auth()->id();
        $booking->room_id = $request->room_id;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        $booking->services = json_encode($request->services); // حفظ الخدمات كـ JSON
        $booking->total_price = $totalPrice;
        $booking->save();
    
        return redirect()->back()->with('success', 'Booking confirmed successfully!');
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