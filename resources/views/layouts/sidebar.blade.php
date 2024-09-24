<div class="sidebar">
    <ul>
      <li>
        @if(auth()->user()->usertype == 'admin')
            <a href="{{ route('admindashboard') }}">
              <div class="logo">
                <span> <img src={{ asset('images/logo.png') }} alt="landing-logo" /> </span>
                <h3>Presence</h3>
              </div>
            </a>
        @elseif(auth()->user()->usertype == 'superadmin')
            <a href="{{ route('superadminadmindashboard') }}">
              <div class="logo">
                <span> <img src={{ asset('images/logo.png') }} alt="landing-logo" /> </span>
                <h3>Presence</h3>
              </div>
            </a>
        @else
            <a href="{{ route('dashboard') }}">
              <div class="logo">
                <span> <img src={{ asset('images/logo.png') }} alt="landing-logo" /> </span>
                <h3>Presence</h3>
              </div>
            </a>
        @endif
      </li>
    </ul>
    <ul>
      <li>
        @if(auth()->user()->usertype == 'admin')
            <a href="{{ route('admindashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house-chimney"></i> 
                <h4>{{ __('Dashboard') }}</h4>
            </a>
        @elseif(auth()->user()->usertype == 'superadmin')
            <a href="{{ route('superadminadmindashboard') }}" class="{{ request()->is('superadmin/dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house-chimney"></i> 
                <h4>{{ __('Dashboard') }}</h4>
            </a>
        @else
            <a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house-chimney"></i>
                <h4>{{ __('Dashboard') }}</h4>
            </a>
        @endif
      </li>
    </ul>
    <ul>
      <li>
        <a href="{{ route('schedule') }}" class="{{ request()->is('schedule') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-days"></i>
            <h4>{{ __('Schedule') }}</h4>
        </a>
      </li>
    </ul>
    <ul>
      <li>
        <a href="{{ route('boards.index') }}" class="{{ request()->is('boards') ? 'active' : '' }}">
            <i class="fa-solid fa-rectangle-list"></i>
            <h4>{{ __('Board') }}</h4>
        </a>
      </li>
    </ul>
    <ul>
      <li>
        <a href="{{ route('attendance') }}" class="{{ request()->is('attendance') ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-user"></i>
            <h4>{{ __('Attendance') }}</h4>
        </a>
      </li>
    </ul>
    @if(auth()->user()->usertype == 'admin' || auth()->user()->usertype == 'superadmin')
    <ul>
      <li>
        <a href="{{ route('admin.db-user') }}" class="{{ request()->is('db/user') ? 'active' : '' }}">
          <i class="fa-solid fa-users"></i>
          <h4>{{ __('User Data') }}</h4>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.db-todo') }}" class="{{ request()->is('db/todo') ? 'active' : '' }}">
          <i class="fa-solid fa-list-check"></i>
          <h4>{{ __('Board Data') }}</h4>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.db-schedule') }}" class="{{ request()->is('db/schedule') ? 'active' : '' }}">
          <i class="fa-solid fa-calendar"></i>
          <h4>{{ __('Schedule Data') }}</h4>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.db-attendance') }}" class="{{ request()->is('db/attendance') ? 'active' : '' }}">
          <i class="fa-solid fa-clipboard"></i>
          <h4>{{ __('Attendance Data') }}</h4>
        </a>
      </li>
      <li>
        <a href="{{ route('logs') }}" class="{{ request()->is('logs') ? 'active' : '' }}">
          <i class="fa-solid fa-clock"></i>
          <h4>{{ __('Activity Logs') }}</h4>
        </a>
      </li>
    </ul>
    @endif
    <ul>
      <li>
        <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
            <i class="fa-solid fa-gamepad"></i>
            <h4>{{ __('Settings') }}</h4>
        </a>
      </li>
    </ul>
</div>