@extends('public_site.layouts.welcome')
@section('title', 'Booking')

@section('content')
<!-- Popup for Success/Error Messages -->
@if(session('success'))
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

@if(session('error'))
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ session('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endif

<div class="back_re">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>Book Your Stay</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- عرض تفاصيل الغرفة إذا تم تحديدها -->
@if(isset($room))
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <center>
                        <img src="{{ asset('images/' . $room->image) }}" alt="{{ $room->name }}" class="img-fluid room-img">
                        <h3 class="card-title">{{ $room->name }}</h3>
                        <p class="card-text">{{ $room->description }}</p>
                        <p class="card-text"><strong>Price: ${{ $room->price }}</strong></p>
                        <p class="card-text"><strong>Room Type:</strong> {{ ucfirst($room->room_type) }}</p>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#bookingModal{{ $room->id }}">Book Now</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Booking Modal -->
@if(isset($room))
<div class="modal fade" id="bookingModal{{ $room->id }}" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel{{ $room->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel{{ $room->id }}">Book {{ $room->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('booking.store') }}" method="POST">
    @csrf
    <input type="hidden" name="room_id" value="{{ $room->id }}">
    
    <div class="form-group">
        <label for="date">Check-in Date</label>
        <input type="date" name="booking_date" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="time">Check-in Time</label>
        <input type="time" name="booking_time" class="form-control" required>
    </div>

    <!-- إضافة خيارات إضافية -->
    <div class="form-group">
        <label>Additional Services</label>
        <div>
            <input type="checkbox" name="breakfast" value="1"> Breakfast<br>
            <input type="checkbox" name="lunch" value="1"> Lunch<br>
            <input type="checkbox" name="dinner" value="1"> Dinner<br>
            <input type="checkbox" name="room_service" value="1"> Room Service<br>
            <input type="checkbox" name="parking" value="1"> Parking<br>
            <input type="checkbox" name="wifi" value="1"> Free Wi-Fi<br>
            <input type="checkbox" name="gym" value="1"> Gym Access<br>
            <input type="checkbox" name="pool" value="1"> Pool Access<br>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Confirm Booking</button>
</form>
        </div>
    </div>
</div>
@endif

<!-- My Bookings Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h2>My Bookings</h2>
            @if(auth()->check())
                @if($bookings->isEmpty())
                    <p>You have no bookings yet.</p>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Room</th>
                                <th>Check-in Date</th>
                                <th>Check-in Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td>{{ $booking->room->name }}</td>
                                <td>{{ $booking->booking_date }}</td>
                                <td>{{ $booking->booking_time }}</td>
                                <td>
                                    <span class="badge 
                                        @if($booking->status == 'confirmed') badge-success
                                        @elseif($booking->status == 'pending') badge-warning
                                        @elseif($booking->status == 'cancelled') badge-danger
                                        @endif">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($booking->status == 'pending')
                                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            @else
                <p>You need to login to view your bookings.</p>
            @endif
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* تنسيق عام للصفحة */
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    /* تنسيق العنوان */
    .title h2 {
        font-size: 36px;
        font-weight: bold;
        color: #007bff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* تنسيق الكارد */
    .card {
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background: white;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-top: 15px;
    }

    .card-text {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
    }

    .card-text strong {
        color: #007bff;
    }

    /* تنسيق الأزرار */
    .btn-primary {
        background: linear-gradient(145deg, #007bff, #0056b3);
        border: none;
        padding: 12px 25px;
        font-size: 16px;
        border-radius: 10px;
        transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
    }

    .btn-primary:hover {
        background: linear-gradient(145deg, #0056b3, #007bff);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 123, 255, 0.4);
    }

    .btn-danger {
        background: linear-gradient(145deg, #dc3545, #c82333);
        border: none;
        padding: 8px 16px;
        font-size: 14px;
        border-radius: 8px;
        transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
    }

    .btn-danger:hover {
        background: linear-gradient(145deg, #c82333, #dc3545);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(220, 53, 69, 0.4);
    }

    /* تنسيق الجدول */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .table th, .table td {
        padding: 12px;
        text-align: center;
        border: 1px solid #e9ecef;
    }

    .table th {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: white;
        font-weight: bold;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    /* تنسيق البادجات */
    .badge {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: bold;
    }

    .badge-success {
        background: linear-gradient(145deg, #28a745, #218838);
        color: white;
    }

    .badge-warning {
        background: linear-gradient(145deg, #ffc107, #e0a800);
        color: black;
    }

    .badge-danger {
        background: linear-gradient(145deg, #dc3545, #c82333);
        color: white;
    }

    /* تنسيق الـ modal */
    .modal-content {
        border-radius: 15px;
        border: none;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        background: white;
    }

    .modal-header {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
        padding: 20px;
        border-bottom: none;
    }

    .modal-title {
        font-size: 24px;
        font-weight: bold;
    }

    .close {
        color: white;
        opacity: 0.8;
        font-size: 28px;
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .close:hover {
        opacity: 1;
        transform: rotate(90deg);
    }

    .modal-body {
        padding: 25px;
    }

    .form-group label {
        font-weight: bold;
        color: #007bff;
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 12px;
        font-size: 16px;
        margin-bottom: 15px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3);
    }

    /* تنسيق الخدمات الإضافية */
    .form-group input[type="checkbox"] {
        margin-right: 10px;
        transform: scale(1.2);
        cursor: pointer;
    }

    .form-group label {
        font-weight: normal;
        color: #555;
        cursor: pointer;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        @if(session('success'))
            $('#successModal').modal('show');
        @endif

        @if(session('error'))
            $('#errorModal').modal('show');
        @endif
    });
</script>
@endpush