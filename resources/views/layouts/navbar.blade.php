<div class="navbar">
    <div class="navbar-content">
      <h4>Hi, <span class="username">{{ Auth::user()->name }}</span> | Today is <span>{{ \Carbon\Carbon::now()->format('l F j, Y') }}</span></h4>
        <div class="navbar-icon-logout-container">
            <div class="dropdown">
                <button class="link icon"><i class="fa-solid fa-bell"></i></button>
                <div class="dropdown-menu">
                    <div class="dropdown-title-close">
                        <h4>Notification</h4>
                        <span class="close">&times;</span>
                    </div>
                    <div class="dropdown-notification">
                        @foreach ($notifications as $notification)
                        @if ($notification->read_at == 0)
                        @if ($notification->schedule)
                        <div class="notification-content">
                            <p class="text-small">Schedule Notification</p>
                            <p>Schedule 
                                    <a href="{{ route('schedule.index', ['workspace' => $notification->schedule->workspace_id, 'id' => $notification->schedule->id]) }}">
                                        {{ $notification->schedule->title }}
                                        {{ $notification->schedule->id }}
                                    </a>
                                    is almost due!
                                </p>
                            </div>
                            @else
                            
                            @endif
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="">
            <form method="POST" action="{{ route('logout') }}" id="logout-form" class="log-out" >
                @csrf
                <a :href="route('logout')" class="icon" id="navbar-log-out">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </form>
        </div>
    </div>
</div>

@include('components.dropdownform')

<script>
    document.getElementById('navbar-log-out').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, log out!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    });
</script>

{{-- <section class="nav">
    <div class="nav-content">
        <div class="nav-title-user">
            <a class="presence-name" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" alt="">
                <h2>Presence</h2>
            </a>
            <div class="nav-user">
                <h3>Hello, <span>{{ Auth::user()->name }}</span></h3>
                <p id="current-date">Today Is</p>
            </div>
        </div>
        <div class="user-profile-log-out">
            <div class="nav-user-profile">
                <i class="fa-solid fa-user"></i>
            </div>
            <form method="POST" action="{{ route('logout') }}" id="logout-form" >
                @csrf
                <a :href="route('logout')" class="icon" id="navbar-log-out">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </form>
        </div>
    </div>    
</section> --}}
