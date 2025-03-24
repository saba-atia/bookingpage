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
 <div  class="our_room">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="titlepage">
                <p  class="margin_0">Lorem Ipsum available, but the majority have suffered </p>
             </div>
          </div>
       </div>

       <div class="row">

       @foreach ($room as $rooms )
           
       
          <div class="col-md-4 col-sm-6">
             <div id="serv_hover"  class="room">
                <div class="room_img">
                   <figure><img style="height: 200px ; width:320px" src="images/{{$rooms->image}}" alt="#"/></figure>
                </div>
                <div class="bed_room">
                   <h3>{{$rooms->room_title}}</h3>
                 
                <p style="padding:10px">{!! Str::limit (room->discription,100)} </p>
               <a class="btn btn-primary" href="{{url('room_details,rooms->id')}}"> Room Details </a>
               
               
               </div>
             </div>
          </div>
       
          @endforeach
@endsection