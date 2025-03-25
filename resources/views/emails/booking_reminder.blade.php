<!DOCTYPE html>
<html>
<head>
    <title>Booking Reminder</title>
</head>
<body>
    <h2>Hello {{ $booking->user->name }},</h2>
    <p>Your booking for <strong>{{ $booking->service->name }}</strong> is confirmed.</p>
    <p>Details:</p>
    <ul>
        <li><strong>Date:</strong> {{ $booking->booking_date }}</li>
        <li><strong>Time:</strong> {{ $booking->booking_time }}</li>
        <li><strong>Room Type:</strong> {{ ucfirst($booking->room_type) }}</li>
    </ul>
    <p>Thank you for choosing us!</p>
</body>
</html>
