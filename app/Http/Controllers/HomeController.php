<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App/Models/Room;

class HomeController extends Controller
{
    public function room_details($id)
    {
$room=Room::find($id);
return view ('layouts.public_site.room_details',compact('room'));
    }

    public function add_booking(Request $request, $id)
    {
        $request->validate([
'startDte'='required|date',
'endDate'=> 'date|after:startDate',
        ]);

        $data=new Booking;
        $data->room_id=$id;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;




        $data->start_date=$request->start_date;
        $data->end_date=$request->end_date;

 
$startDate=$request->startDate;
$endDate=$request->endDate;

$isBooked=Booking::where('room_id','$id')
->where('start_date','<=',$endDate)
->where('end_date','>=',$startDate)->exists();

if($isBooked)
{
    return redirect()->back()->with('message','Room Booked already booked please try different date');

}
else{

    $data->start_date=$request->start_date;
    $data->end_date=$request->end_date;

    $date->save();
    return redirect()->back()->with('message','Room Booked successfully');

}

        
       
 
    }
}
