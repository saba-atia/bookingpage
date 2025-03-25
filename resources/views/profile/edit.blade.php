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
            <div class="col-12 col-lg-auto mb-3" style="width: 230px;">
                <div class="card p-3">
                    <div class="e-navlist e-navlist--active-bg">
                        <ul class="nav">
                            <li class="nav-item"><a class="nav-link px-2 active" href="#"><i class="fa fa-fw fa-bar-chart mr-1"></i> Overview</a></li>
                            <li class="nav-item"><a class="nav-link px-2" href="{{ route('profile.payment') }}"><i class="fa fa-fw fa-credit-card mr-1"></i> Payment History</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
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

                            <ul class="nav nav-tabs">
                                <li class="nav-item"><a href="#" class="active nav-link">Settings</a></li>
                            </ul>
                            <div class="tab-content pt-3">
                                <div class="tab-pane active">
                                    <!-- Form for updating profile -->
                                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')

                                        <!-- Profile Picture Upload -->
                                        <div class="form-group">
                                            <label>Profile Picture</label>
                                            <input type="file" class="form-control" name="profile_picture" accept="image/*">
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input class="form-control" type="email" name="email" value="{{ Auth::user()->email }}">
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6 mb-3">
                                                <b>Change Password</b>
                                                <div class="form-group">
                                                    <label>New Password</label>
                                                    <input class="form-control" type="password" name="password" >
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Password</label>
                                                    <input class="form-control" type="password" name="password_confirmation" >
                                                </div>
                                            </div>
                                            
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col d-flex justify-content-end">
                                                <button class="btn btn-warning" type="submit">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Logout Button -->
                <div class="col-12 col-md-3 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="/" class="btn btn-block btn-warning">
                                <i class="fa-solid fa-xmark"></i> Back
                            </a>
                        </div>
                        
                        <div class="card-body">
                            <button class="btn btn-block btn-danger" onclick="document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out"></i> Logout
                            </button>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>
