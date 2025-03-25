@extends('public_site.layouts.welcome')
@section('title', 'Edit Booking')

@section('content')
<div class="container">
    <h2>Edit Booking</h2>

    <form action="{{ route('booking.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Pick a Date</label>
            <input type="date" name="booking_date" value="{{ $booking->booking_date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Pick a Time</label>
            <input type="time" name="booking_time" value="{{ $booking->booking_time }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
</div>
@endsection
