<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LuxeLodge</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap 4.1.1 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row flex-lg-nowrap">
            <!-- Sidebar -->
            <div class="col-12 col-lg-auto mb-3" style="width: 230px;">
                <div class="card p-3">
                    <div class="e-navlist e-navlist--active-bg">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link px-2 active" href="{{ route('profile.edit') }}">
                                    <i class="fa fa-fw fa-bar-chart mr-1"></i> Overview
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-2" href="{{ route('profile.payment') }}">
                                    <i class="fa fa-fw fa-credit-card mr-1"></i> Payment History
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
    
            <!-- Content Area -->
            <div class="col">
                <div class="d-flex justify-content-between mb-4">
                    <!-- Back and Logout Buttons -->
                    <div class="d-flex">
                        <a href="/" class="btn btn-warning me-2">
                            <i class="fa-solid fa-xmark"></i> Back
                        </a>
                        <button class="btn btn-danger" onclick="document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> Logout
                        </button>
                    </div>
                </div>
    
                <div class="card">
                    <div class="card-body">
                        <div class="e-profile">
                            <div class="row">
                                <div class="col-12 col-sm-auto mb-3">
                                    <div class="mx-auto" style="width: 140px;">
<img src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : 'https://i.pinimg.com/474x/07/1a/32/071a32648a9ca4aebad44fa4eb43c276.jpg' }}" class="rounded-circle" width="140" height="140" alt="Profile Image">
                                    </div>
                                </div>
                                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                    <div class="text-center text-sm-left">
                                        <h4 class="pt-sm-2 pb-1 mb-0">{{ Auth::user()->name }}</h4>
                                        <div class="text-muted"><small>Last seen 2 hours ago</small></div>
                                    </div>
                                    <div class="text-center text-sm-right">
                                        <span class="badge badge-secondary">User</span>
                                        <div class="text-muted"><small>Joined {{ Auth::user()->created_at->format('d M Y') }}</small></div>
                                    </div>
                                </div>
                            </div>
    
                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
    
                            <!-- Payment History Table -->
                            @if(isset($bookings) && $bookings->isNotEmpty())
                                <h3 class="text-center mb-4">Payment History</h3>
                                <table class="table table-striped table-bordered text-center">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>Service</th>
                                            <th>Booking Date</th>
                                            <th>Payment Status</th>
                                            <th>Payment Method</th>
                                            <th>Amount Paid</th>
                                            <th>Review & Rating</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookings as $booking)
                                            <tr>
                                                <td>{{ $booking->service->name ?? 'N/A' }}</td>
                                                <td>{{ $booking->booking_date }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $booking->payment_status == 'paid' ? 'success' : 'warning' }}">
                                                        {{ ucfirst($booking->payment_status ?? 'pending') }}
                                                    </span>
                                                </td>
                                                <td>{{ ucfirst($booking->payment_method ?? 'Not Set') }}</td>
                                                <td>${{ number_format($booking->amount_paid ?? 0, 2) }}</td>
                                                <td>
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $booking->id }}">
                                                        Leave Review
                                                    </button>
    
                                                    <!-- Review Modal -->
                                                    <div class="modal fade" id="reviewModal{{ $booking->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $booking->id }}" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Leave a Review</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('review.store') }}" method="POST">
                                                                        @csrf
                                                                        <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                                                        
                                                                        <div class="mb-3">
                                                                            <label for="rating" class="form-label">Rating</label>
                                                                            <select name="rating" class="form-select" required>
                                                                                <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                                                                                <option value="4">⭐⭐⭐⭐ (Very Good)</option>
                                                                                <option value="3">⭐⭐⭐ (Good)</option>
                                                                                <option value="2">⭐⭐ (Fair)</option>
                                                                                <option value="1">⭐ (Poor)</option>
                                                                            </select>
                                                                        </div>
                                                                        
                                                                        <div class="mb-3">
                                                                            <label for="review" class="form-label">Your Review</label>
                                                                            <textarea name="review" class="form-control" rows="3" placeholder="Write your review here..." required></textarea>
                                                                        </div>
    
                                                                        <button type="submit" class="btn btn-success">Submit Review</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Review Modal -->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <div class="alert alert-info text-center">
                                    You have no payment history yet.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Hidden Logout Form -->
    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
        @csrf
    </form>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    