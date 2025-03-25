<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Mail\BookingReminder;
use Illuminate\Support\Facades\Mail;


class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();
        
         
       $services = Service::where('is_available', true);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->has('room_type')) {
            $query->where('room_type', $request->room_type);
        }

        if ($request->has('sort') && $request->has('direction')) {
            $query->orderBy($request->sort, $request->direction);
        }

        $services = $query->get();

        $bookings = [];
        if (auth()->check()) {
            $bookings = Booking::where('user_id', auth()->id())->get();
        }

        return view('public_site.layouts.room_details', compact('services', 'bookings'));
    }
    public function confirm($id)
{
    $booking = Booking::findOrFail($id);
    $booking->status = 'confirmed';
    $booking->save();

    // Send Reminder Email
    Mail::to($booking->user->email)->send(new BookingReminder($booking));

    return redirect()->back()->with('success', 'Booking confirmed, and reminder email sent!');
}


public function store(Request $request)
{
    $request->validate([
        'room_id' => 'required|exists:rooms,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:20',
        'check_in' => 'required|date',
        'check_out' => 'required|date|after:check_in',
    ]);

    $booking = Booking::create($request->all());

    // إرسال رسالة success إلى الجلسة بعد الحجز بنجاح
    return redirect()->route('room.details', $request->room_id)
                     ->with('success', 'Your room has been booked successfully!');
}

public function showPaymentPage($id)
{
    $booking = Booking::findOrFail($id);  // استرجاع الحجز بناءً على ID
    return view('payment.confirm', compact('booking'));  // عرض الصفحة مع تفاصيل الحجز
}


    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('booking.index')->with('success', 'Booking cancelled successfully!');
    }
    public function paymentHistory()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view your payment history.');
        }
    
        $bookings = Booking::where('user_id', auth()->id())->with('service')->get();
        return view('profile.payment', compact('bookings'));
    }
    public function processPayment(Request $request)
    {
        // استرجاع الحجز بناءً على ID الحجز المرسل
        $booking = Booking::findOrFail($request->booking_id);

        // تحديد المبلغ الكلي بناءً على المبلغ بالـ عملة (مثلاً الدولار) مع تحويله إلى سنتات (لأن Stripe يتعامل بالسنتات)
        $totalAmount = $request->amount * 100; // المبلغ بالـ سنتات

        // إعداد Stripe مع API Key الخاصة بك
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // إنشاء عملية الدفع باستخدام Stripe
            $charge = \Stripe\Charge::create([
                'amount' => $totalAmount, // المبلغ
                'currency' => 'usd', // العملة
                'source' => $request->stripeToken, // بيانات البطاقة التي حصلنا عليها من الـ Stripe Elements أو Checkout
                'description' => 'Booking payment for ' . $booking->room->room_title, // وصف الحجز
            ]);

            // إذا تم الدفع بنجاح، نقوم بتحديث حالة الدفع في قاعدة البيانات
            if ($charge->status == 'succeeded') {
                // تحديث حالة الدفع في الحجز
                $booking->payment_status = 'paid';
                $booking->save();

                // إعادة التوجيه إلى صفحة تأكيد الدفع مع رسالة نجاح
                return redirect()->route('payment.success', ['id' => $booking->id])
                                 ->with('success', 'Payment successful! Your booking is confirmed.');
            }

        } catch (\Exception $e) {
            // إذا حدث خطأ، نعرض رسالة خطأ للمستخدم
            return redirect()->route('payment.failed', ['id' => $booking->id])
                             ->with('error', 'Payment failed. Please try again.');
        }
    }
    


}
