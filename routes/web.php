<?php

use App\Http\Controllers\RoomBookingController;
use App\Http\Controllers\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;

Route::get('/profile/payment', [ProfileController::class, 'showPaymentHistory'])->name('profile.payment');

Route::get("/review", function(){
    return view("users.r");
});
// Email Verification Routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::post('/booking/confirm/{id}', [BookingController::class, 'confirm'])->name('booking.confirm');

// Public Pages
Route::get('/about', function () {
    return view('public_site.layouts.aboutpage');
});

Route::get('/ourroom', function () {
    return view('public_site.layouts.roompage');
});

Route::get('/gallery', function () {
    return view('public_site.layouts.gallerypage');
});
Route::get('/profile/payment', [BookingController::class, 'paymentHistory'])->name('profile.payment');


Route::get('/blog', function () {
    return view('public_site.layouts.blogpage');
});

Route::get('/contact', function () {
    return view('public_site.layouts.contactpage');
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/', function () {
    return view('public_site.layouts.homepage');
});

// Dashboard (Requires Authentication & Email Verification)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashborde.layouts.dashbord');
    })->name('dashboard');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Booking Routes
Route::middleware('auth')->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/search', [BookingController::class, 'search'])->name('booking.search');
    Route::delete('/booking/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
});

// Users Resource Routes
Route::resource('users', UsersController::class);

// Logout Route
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::resource('admins', AdminController::class);
Route::resource('users', UsersController::class);

Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');


                    // ..................................raneem....................................

                    Route::get('/booking', [AdminController::class,'booking']);
                    Route::get('/create_room', [AdminController::class,'create_room']);
                    Route::post('/add_room', [AdminController::class,'add_room']);
                    Route::get('/messages', [AdminController::class,'messages']);
                    Route::get('/send_email/{id}', [AdminController::class, 'send_email']);
                    Route::post('/mail/{id}', [AdminController::class,'mail']);
                    Route::get('/display_room', [AdminController::class,'display_room']);
                    Route::get('/room_delete/{id}', [AdminController::class,'room_delete']);
                    // Route::delete('/room_delete/{id}', [AdminController::class, 'room_delete'])->name('room_list');
                    Route::get('/room_update/{id}', [AdminController::class,'room_update']);
                    Route::Post('/room_edit/{id}', [AdminController::class,'room_edit']);
                    Route::get('/delete_booking/{id}', [AdminController::class,'delete_booking'])->name('delete_booking');
                    Route::get('/approve_book/{id}', [AdminController::class,'approve_book']);
                    Route::get('/Rejected_book/{id}', [AdminController::class,'Rejected_book']);
                   

                    // ............................................................................
                   

Route::get('/room_details/{id}',[HomeController::class,'room_details']);
Route::post('/add_booking/{id}',[HomeController::class,'add_booking']);
Route::get('/rooms', [HomeController::class, 'rooms'])->name('rooms');
require __DIR__.'/auth.php';

Route::get('/room-details/{id}', [RoomController::class, 'show'])->name('room.details');

Route::get('/book-room/{id}', [RoomBookingController::class, 'create'])->name('booking.form');
Route::post('/book-room', [RoomBookingController::class, 'store'])->name('booking.store');

Route::post('/book-room', [RoomBookingController::class, 'store'])->name('booking.index');
