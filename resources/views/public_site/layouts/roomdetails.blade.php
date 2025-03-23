@extends('public_site.layouts.welcome')
@section('title' , 'Room Details')

@section('content')
<div class="back_re">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="title">
                <h2>{{ $room->name }}</h2>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="our_room">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="room_img">
                <figure><img src="{{ asset('images/' . $room->image) }}" alt="{{ $room->name }}"/></figure>
             </div>
             <div class="bed_room">
                <h3>{{ $room->name }}</h3>
                <p>{{ $room->description }}</p>
                <p>Price: ${{ $room->price }}</p>
                <p>Capacity: {{ $room->capacity }} persons</p>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection