@extends('public_site.layouts.welcome')

@section('title', 'Room Details')

@section('content')

<!-- loader -->
<div class="loader_bg" id="loader-bg">
   <div class="loader"><img src="{{ asset('images/loading.gif') }}" alt="Loading..."/></div>
</div>

<!-- Room Details Section -->
<div class="our_room" style="background-color: #0F1521; padding: 40px 0;">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="title" style="text-align: center; margin-bottom: 30px;">
                <h2 style="font-size: 36px; font-weight: bold; color: white; text-transform: uppercase;">OUR ROOM</h2>
                <div style="width: 100px; height: 3px; background-color: #ff6b6b; margin: 15px auto;"></div>
             </div>
          </div>
       </div>
    </div>
</div>

<div class="room_details" style="padding: 60px 0;">
    <div class="container">
       <div class="row">
          <div class="col-md-8 offset-md-2">
             <div class="room" style="background: white; box-shadow: 0 0 20px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden;">
                <div class="room_img">
                   <figure><img style="width:100%; height: 400px; object-fit: cover;" src="{{ asset('images/' . $room->image) }}" alt="{{ $room->room_title }}"/></figure>
                </div>
                <div class="bed_room" style="padding: 30px;">
                   <h3 style="font-size: 28px; color: #333; margin-bottom: 20px;">{{ $room->room_title }}</h3>
                   <p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;"><strong style="color: #555;">Description:</strong> {!! $room->desecription !!}</p>
                   <p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;"><strong style="color: #555;">Price:</strong> ${{ $room->price }}</p>
                   <p style="font-size: 16px; line-height: 1.6; margin-bottom: 15px;"><strong style="color: #555;">WiFi:</strong> {{ $room->wifi ? 'Available' : 'Not Available' }}</p>
                   <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px;"><strong style="color: #555;">Room Type:</strong> {{ $room->room_type }}</p>
                   <a class="btn btn-danger" href="{{ route('booking.form', ['id' => $room->id]) }}" style="background-color: #ff6b6b; border: none; padding: 12px 30px; font-size: 16px; border-radius: 4px; text-transform: uppercase; font-weight: bold;">Book Now</a>
                </div>
             </div>
          </div>
       </div>
    </div>
</div>

@endsection

<script>
    // إخفاء الـ loader بعد 3 ثواني من تحميل الصفحة
    window.onload = function() {
        setTimeout(function() {
            document.getElementById('loader-bg').style.display = 'none'; // إخفاء الـ loader بعد 3 ثواني
        }, 3000); // 3000 ميلي ثانية = 3 ثواني
    };
</script>