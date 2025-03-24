@extends('public_site.layouts.welcome')
@section('title' , 'room details')

@section('content')
<div class="row">

  <center>      
    
       <div class="col-md-8">
          <div id="serv_hover"  class="room">
             <div style="padding:20px" class="room_img">
                <figure><img style="height: 300px ; width:800px" src="images/{{$room->image}}" alt="#"/></figure>
             </div>
             <div class="bed_room">
                <h2>{{room->room_title}} </h2>
              
             <p style="padding:12px">{{$room->description}}</p>
            <h4 style="padding:12px">Free wifi :{{$room->wifi}}</h4>
            <h4 style="padding:12px"> Room Type :{{$room->room_type}}</h4>
            <h4 style="padding:12px"> Price :{{$room->room_price}}</h4>

            </div>
          </div>
       </div>

       <div class="col-md-4">
      <h1 style="font-size:40px !important">Book Room</h1>

@if(session()->has('message'))

<div class="alert alert-success">
    <button type="button" class="close" data-bs-dismiss="alert">X </button>
    {{session()->get('message')}}

</div>

@endif



      @if(errors)

      @foreach ($errors->all() as $errors )
      <li style="color"red>
        {{$errors}}
      </li>
      


      
      @endforeach
          @endif
      @endforeach
       
      <form action="{{url('add_booking' ,$room->id)}}" mathod="post">
    @csrf
        
    
 
      <div>
       <label> Name </label>
       <input type="text" name="name"
       @if(Auth::id())   
        value="{{Auth ::user()->name}}"
        @endif
        >
    </div>  
    
    <div>
        <label>Email</label>
        <input type="email" name="email"
        
        @if(Auth::id())   
        value="{{Auth ::user()->email}}"
        @endif
        >
        
        >
     </div>   

     <div>
        <label>Phone</label>
        <input type="number" name="phone"
        >
        
        >
     </div>   

     <div>
        <label>Start Date</label>
        <input type="date" name="staertDate" id=startDate>
     </div>   

     <div>
        <label> End Date </label>
        <input type="date" name="endDate" id="endDate">
     </div>   
<div style="padding-top:20px">
     <div>
        <input type="submit" style="background-color: skyblue;" class="btn-btn primary" value="Book Room">
     </div>   
    </form>
</div>

  </center>
    @endsection

@push('styles')
<style type="text/css">
  label{
    display: inline-block;
    width: 200px;
  }
  input {
    width: 100%;
  }


@endpush
    
@endpush




    @push('scripts')
  <script type="text/javascript">
  $(function(){

var dtToday = new Data();
var month = dtToday.getMonth() + 1;
var day = dtToday.getDate();
var year = dtToday.getFullYear();
if(month < 10)
month = '0' + month.toString();
if(day < 10)
day = '0' + day.toString();

var maxDate = year + '-' + month + '-' + day;
$('#startDate').attr('min', maxDate);
$('#endDate').attr('min', maxDate);



  });
  
    @endpush