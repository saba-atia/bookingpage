<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Contact;
use Notification;
use App\Notifications\SendEmailNotification;

class AdminController extends Controller
{
    public function dashboard()
    {
        $adminCount = Admin::count();
        $userCount = User::count();
        return view('dashborde.layouts.dashbord', compact('adminCount', 'userCount'));
    }

    public function profile()
    {
        $admin = Admin::first();
        return view('admins.profile', compact('admin'));
    }

    public function index()
    {
        $admins = Admin::paginate(5);
        return view('admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
    
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('admin_images', 'public');
        }

        Admin::create($data);
        return redirect()->route('admins.index')->with('success', 'Admin created successfully!');
    }

    public function edit(Admin $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:6',
            'phone' => 'nullable|string|max:15',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('admin_images', 'public');
        }

        $admin->update($data);
        return redirect()->route('admins.index')->with('success', 'Admin updated successfully!');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully!');
    }

    public function booking()
    {
        $datas = Booking::with('room')->get();
        return view('dashborde.pages.booking', compact('datas'));
    }

    public function messages()
    {
        $datas = Contact::paginate(2);
        return view('dashborde.pages.messages', compact('datas'));
    }

    public function send_email($id)
    {
        $data = Contact::findOrFail($id);
        return view('dashborde.pages.send_email', compact('data'));
    }

    public function mail(Request $request, $id)
    {
        $data = Contact::findOrFail($id);
        $details = [
            'greeting' => $request->input('greeting'),
            'emailbody' => $request->input('emailbody'),
            'action_text' => $request->input('action_text'),
            'action_url' => $request->input('action_url'),
            'endline' => $request->input('endline'),
        ];
        $data->notify(new SendEmailNotification($details));
        return redirect()->back()->with('success', 'Email sent successfully!');
    }

    public function create_room()
    {
        return view('dashborde.pages.room');
    }

    public function add_room(Request $request)
    {
        $data = new Room();
        $data->room_title = $request->title;
        $data->desecription = $request->description;
        $data->room_type = $request->type;
        $data->price = $request->Price;
        $data->wifi = $request->wifi;
        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }
        $data->save();
        return redirect()->back();
    }

    public function display_room()
    {
        $datas = Room::all();
        return view('dashborde.pages.display_room', compact('datas'));
    }

    public function room_delete($id)
    {
        Room::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function room_update($id)
    {
        $data = Room::findOrFail($id);
        return view('dashborde.pages.room_update', compact('data'));
    }

    public function room_edit(Request $request, $id)
    {
        $data = Room::findOrFail($id);
        $data->room_title = $request->title;
        $data->desecription = $request->desecription;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->room_type;
        if ($request->hasFile('image')) {
            $imagename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }
        $data->save();
        return redirect()->back();
    }

    public function delete_booking($id)
    {
        Booking::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function approve_book($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approve';
        $booking->save();
        return redirect()->back();
    }

    public function rejected_book($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();
        return redirect()->back();
    }
}