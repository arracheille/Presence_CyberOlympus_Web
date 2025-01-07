<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Presence</title>

        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

        @include('components.css')
    </head>
    <body>
        <div class="container landing">
            <div class="logo">
              <span> <img src="images/logo.png" alt="landing-logo" /> </span>
              <h3>Presence</h3>
            </div>
            <div class="landing-container">
              <div class="landing-content">
                <h2>
                  Keep track of <span class="gradient-text-orange">attendance</span>, <span class="gradient-text-blue">schedule meetings</span>, and <span class="gradient-text-green">manage tasks</span> efficiently in one place with <span>Presence</span>.
                </h2>
                @if (Route::has('login'))
                <nav class="landing-buttons-container">
                    @auth
                        @if (auth()->user()->usertype == 'admin')
                            <a class="btn" href="{{ route('admindashboard') }}">Admin Dashboard</a>
                        @elseif (auth()->user()->usertype == 'superadmin')
                            <a class="btn" href="{{ route('superadminadmindashboard') }}">Superadmin Dashboard</a>
                        @else
                            <a class="btn" href="{{ route('dashboard') }}">Dashboard</a>
                        @endif
                        @else
                            <a class="btn" href="{{ route('login') }}" > Log In </a>
                        @if (Route::has('register'))
                            <a class="btn" href="{{ route('register') }}" class="welcome-register" > Register </a>
                        @endif
                    @endauth
                </nav>
                @endif
              </div>
            </div>
        </div>
    </body>
</html>
