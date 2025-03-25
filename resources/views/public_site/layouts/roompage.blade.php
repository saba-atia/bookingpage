@extends('public_site.layouts.welcome')
@section('title', 'Our Rooms')

@section('content')
<div class="back_re">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="title">
                <h2>Our Room</h2>
             </div>
          </div>
       </div>
    </div>
</div>

<!-- our_room -->
<div class="our_room">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="titlepage">
                <p class="margin_0">At LuxLodge, we offer a variety of rooms and suites designed to meet your every need. Whether you're traveling solo, with family, or on a romantic getaway, we have the perfect space for you.
               </p>
             </div>
          </div>
       </div>

       <div class="row">
          @foreach ($rooms as $room)
          <div class="col-md-4 col-sm-6">
             <div id="serv_hover" class="room">
                <div class="room_img">
                   <figure><img style="height: 200px; width:320px" src="{{ asset('images/' . $room->image) }}" alt="#"/></figure>
                </div>
                <div class="bed_room">
                   <h3>{{ $room->room_title }}</h3>
                   <p style="padding:10px">{!! $room->desecription !!}</p> <!-- تم تعديل هذه السطر لعرض الوصف الكامل -->
                   <a class="btn btn-danger" href="{{ url('room_details', $room->id) }}"> Room Details </a>
                </div>
             </div>
          </div>
          @endforeach
       </div>
    </div>
</div>
@endsection