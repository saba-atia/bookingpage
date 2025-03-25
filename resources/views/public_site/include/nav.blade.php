<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LuxeLodge</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap 4.1.1 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Inline CSS -->
    <style>
        .nav-item.dropdown .dropdown-menu {
            margin-top: 5px;  
            border-radius: 5px;  
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
            right: 0; 
        }

        .nav-item.dropdown .nav-link img {
            vertical-align: middle;  
            width: 35px;
            height: 35px;
        }

        .dropdown-menu {
            min-width: 120px;
        }

        .dropdown-menu a {
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <nav class="navigation navbar navbar-expand-md navbar-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/rooms">Our Room</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact Us</a>
                </li>

                @if (Route::has('login'))
                    @auth
                        <!-- Profile Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ Auth::user()->profile_picture ? asset('storage/profile_pictures/' . Auth::user()->profile_picture) : 'https://i.pinimg.com/474x/07/1a/32/071a32648a9ca4aebad44fa4eb43c276.jpg' }}" alt="Profile" class="rounded-circle" width="35" height="35">
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="{{ url('/profile') }}">Profile</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </nav>
</body>
</html>
