@extends('public_site.layouts.welcome')
@section('title', 'Our Rooms')

@section('content')
<div class="back_re">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title">
                    <h2>Our Luxurious Rooms</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Our Rooms Section -->
<div class="our_room">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="titlepage">
                    <p class="margin_0">At LuxLodge, we offer a variety of rooms and suites designed to meet your every need. Whether you're traveling solo, with family, or on a romantic getaway, we have the perfect space for you.</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($rooms as $room)
            <div class="col-md-4 col-sm-6">
                <div id="serv_hover" class="room">
                    <div class="room_img">
                        <figure>
                            <img src="{{ asset('images/' . $room->image) }}" alt="{{ $room->name }}" class="img-fluid">
                        </figure>
                    </div>
                    <div class="bed_room">
                        <h3>{{ $room->name }}</h3>
                        <p>{{ $room->description }}</p>
                        <a href="{{ route('booking.index', ['room_id' => $room->id]) }}" class="btn btn-primary">Explore Room</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection