<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body style="background-color:#181818; color:white;">
    <div class="container">
        <header class="mt-3 mb-3">
        <h2 style="margin-left:5px;">@yield('header')</h2>
        </header>
        <main>
        <div class="row">
            <div class="col-2">
                <ul class="nav flex-column" style="background-color:#202020;">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/workouts">Workouts</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/activities">Activities</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">About</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="/workouts/favorites">FavWorkouts</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/workouts/myworkouts">MyWorkouts</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users">Users</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/following">Following</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/subscribers">Subscribers</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profile">Profile</a>
                        <hr style="background-color:grey; margin:0px;">
                    </li>
                    @endif
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Log Out</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                            <hr style="background-color:grey; margin:0px;">
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/signup">Sign Up</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-9">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('failure'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failure') }}
                    </div>
                @endif
            <div style="color:white;">
                @yield('content')
            </div>
            </div>
        </div>
        </main>
    </div>
</body>
</html>