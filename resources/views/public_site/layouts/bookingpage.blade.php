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
                    <h2>Book a Service</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search and Filter Section -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('booking.index') }}" method="GET">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search services..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">
            <select class="form-control" onchange="window.location.href = this.value">
                <option value="{{ route('booking.index') }}">Filter By</option>
                <option value="{{ route('booking.index', ['room_type' => 'single']) }}" {{ request('room_type') == 'single' ? 'selected' : '' }}>Single Room</option>
                <option value="{{ route('booking.index', ['room_type' => 'double']) }}" {{ request('room_type') == 'double' ? 'selected' : '' }}>Double Room</option>
                <option value="{{ route('booking.index', ['room_type' => 'suite']) }}" {{ request('room_type') == 'suite' ? 'selected' : '' }}>Suite</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control" onchange="window.location.href = this.value">
                <option value="{{ route('booking.index') }}">Sort By</option>
                <option value="{{ route('booking.index', ['sort' => 'price', 'direction' => 'asc']) }}" {{ request('sort') == 'price' && request('direction') == 'asc' ? 'selected' : '' }}>Price: Low to High</option>
                <option value="{{ route('booking.index', ['sort' => 'price', 'direction' => 'desc']) }}" {{ request('sort') == 'price' && request('direction') == 'desc' ? 'selected' : '' }}>Price: High to Low</option>
            </select>
        </div>
    </div>
</div>

<!-- Service Listings -->
<div class="our_room">
   <div class="container">
       <div class="row">
           @foreach($services as $service)
           <div class="col-md-4 col-sm-6 mb-4">
               <div id="serv_hover" class="room card h-100">
                   <div class="room_img card-img-top">
                       <figure>
                           @if($service->room_type == 'single')
                               <img src="{{ asset('images/single room.png') }}" alt="Single Room" class="img-fluid">
                           @elseif($service->room_type == 'double')
                               <img src="{{ asset('images/double room.png') }}" alt="Double Room" class="img-fluid">
                           @elseif($service->room_type == 'suite')
                               <img src="{{ asset('images/suite.png') }}" alt="Suite Room" class="img-fluid">
                           @else
                               <img src="{{ asset('images/default_room.jpg') }}" alt="Default Room" class="img-fluid">
                           @endif
                       </figure>
                   </div>
                   <div class="bed_room card-body">
                       <h3 class="card-title">{{ $service->name }}</h3>
                       <p class="card-text">{{ $service->description }}</p>
                       <p class="card-text"><strong>Price: ${{ $service->price }}</strong></p>

                       <!-- عرض الخدمات الإضافية -->
                       <div class="service-options mb-3">
                           @if($service->room_type)
                               <p class="card-text"><strong>Room Type:</strong> {{ ucfirst($service->room_type) }}</p>
                           @endif
                           @if($service->breakfast)
                               <p class="card-text"><strong>Includes Breakfast</strong></p>
                           @endif
                           @if($service->lunch)
                               <p class="card-text"><strong>Includes Lunch</strong></p>
                           @endif
                           @if($service->dinner)
                               <p class="card-text"><strong>Includes Dinner</strong></p>
                           @endif
                           @if($service->room_service)
                               <p class="card-text"><strong>Room Service Available</strong></p>
                           @endif
                           @if($service->parking)
                               <p class="card-text"><strong>Parking Available</strong></p>
                           @endif
                           @if($service->wifi)
                               <p class="card-text"><strong>Free Wi-Fi</strong></p>
                           @endif
                           @if($service->gym)
                               <p class="card-text"><strong>Gym Access</strong></p>
                           @endif
                           @if($service->pool)
                               <p class="card-text"><strong>Pool Access</strong></p>
                           @endif
                       </div>

                       <button class="btn btn-primary" data-toggle="modal" data-target="#bookingModal{{ $service->id }}">Book Now</button>
                   </div>
               </div>
           </div>

           <!-- Booking Modal -->
           <div class="modal fade" id="bookingModal{{ $service->id }}" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel{{ $service->id }}" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="bookingModalLabel{{ $service->id }}">Book {{ $service->name }}</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <form action="{{ route('booking.store') }}" method="POST">
                               @csrf
                               <input type="hidden" name="service_id" value="{{ $service->id }}">
                               
                               <div class="form-group">
                                   <label for="date">Date</label>
                                   <input type="date" name="booking_date" class="form-control" required>
                               </div>
                               <div class="form-group">
                                   <label for="time">Time</label>
                                   <input type="time" name="booking_time" class="form-control" required>
                               </div>

                               <!-- إضافة خيارات إضافية -->
                               <div class="form-group">
                                   <label for="room_type">Room Type</label>
                                   <select name="room_type" class="form-control" required>
                                       <option value="single">Single Room</option>
                                       <option value="double">Double Room</option>
                                       <option value="suite">Suite</option>
                                   </select>
                               </div>
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
           </div>
           @endforeach
       </div>
   </div>
</div>

<!-- My Bookings Section -->
<div class="container mt-5">
   <div class="row">
       <div class="col-md-12">
           <h2>My Bookings</h2>
           @if(auth()->check())
               @if($bookings->isEmpty()) <!-- استخدام isEmpty() للتحقق من وجود بيانات -->
                   <p>You have no bookings yet.</p>
               @else
                   <table class="table table-bordered">
                       <thead>
                           <tr>
                               <th>Service</th>
                               <th>Date</th>
                               <th>Time</th>
                               <th>Status</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           @foreach($bookings as $booking)
                           <tr>
                               <td>{{ $booking->service->name }}</td>
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