@extends('public_site.layouts.welcome')

@section('title', 'Book Room')

@section('content')

<!-- loader -->
<div class="loader_bg" id="loader-bg">
    <div class="loader"><img src="{{ asset('images/loading.gif') }}" alt="Loading..."/></div>
</div>

<div class="container mt-5">
    <h2 class="text-center mb-4">Book Room: {{ $room->room_title }}</h2>

    <!-- عرض الرسالة إذا كانت موجودة -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('booking.store') }}" method="POST" class="shadow-lg p-4 rounded">
        @csrf
        <input type="hidden" name="room_id" value="{{ $room->id }}">

        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required placeholder="Enter your name">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required placeholder="Enter your email">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control" required placeholder="Enter your phone number">
        </div>

        <div class="mb-3">
            <label for="check_in" class="form-label">Check-in Date:</label>
            <input type="date" id="check_in" name="check_in" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="check_out" class="form-label">Check-out Date:</label>
            <input type="date" id="check_out" name="check_out" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method:</label>
            <select id="payment_method" name="payment_method" class="form-control" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash_on_arrival">Cash on Arrival</option>
            </select>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-danger px-4 py-2 w-50">Confirm Booking</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            title: 'Success!',
            text: 'Your room has been booked successfully!',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif

    // إخفاء الـ loader بعد 3 ثواني من تحميل الصفحة
    window.onload = function() {
        setTimeout(function() {
            document.getElementById('loader-bg').style.display = 'none'; // إخفاء الـ loader بعد 3 ثواني
        }, 3000); // 3000 ميلي ثانية = 3 ثواني
    };
</script>

@endsection
