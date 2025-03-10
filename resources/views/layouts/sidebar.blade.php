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
  @if (request()->is('board-task/*') || request()->is('workspace/*') || request()->is('boards/*') || request()->is('schedule/*') || request()->is('attendance') || request()->is('members/*'))
  <ul>
    <li>
      @foreach ($workspaces as $workspace)
      <a href="{{ route('workspaces.dashboard', ['workspace' => $workspace->id]) }}" 
        class="{{ Route::is('workspaces.dashboard', ['workspace' => $workspace->id]) ? 'active' : '' }}">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon-small" alt="Avatar">
        <h4>Workspace</h4>
      </a>
      @endforeach
    </li>
  </ul>
  <ul>
    @foreach ($workspaces as $workspace)
    <li>
      <a href="{{ route('members.index', ['workspace' => $workspace->id]) }}" 
        class="{{ Route::is('members.index', ['workspace' => $workspace->id]) ? 'active' : '' }}">
        <i class="fa-solid fa-user"></i>
        <h4>{{ __('Members') }}</h4>
      </a>
    </li>
    @endforeach
  </ul>
  <ul>
  @foreach ($workspaces as $workspace)
    <li class="list-data">
      <a href="{{ route('boards.index', ['workspace' => $workspace->id]) }}" 
        class="{{ Route::is('boards.index', ['workspace' => $workspace->id]) ? 'active' : '' }}">
        <i class="fa-solid fa-tachograph-digital"></i>
        <h4>{{ __('Board') }}</h4>
      </a>
    </li>
    @foreach ($workspace->boards as $board)
    @if ($board->visibility === 'private' && $board->user_id === auth()->user()->id)
      @php
        $board_color = match ($board['background_color']) {
          'gradient-orange' => 'gradient-orange',
          'gradient-blue' => 'gradient-blue',
          'gradient-green' => 'gradient-green',
          'gradient-red' => 'gradient-red',
          'gradient-pink' => 'gradient-pink',
          'gradient-purple' => 'gradient-purple',
          default => 'darkblue',
        };
      @endphp
      <li class="subdata">
        <a href="{{ route('boards.index', ['workspace' => $workspace->id]) }}" id="{{ $board_color }}"
          class="{{ Route::is('boards.index', ['workspace' => $workspace->id]) ? 'active' : '' }}">  
          <p>{{ $board->title }}</p>
        </a>
      </li>
    @elseif ($board->visibility !== 'private')
      @php
        $board_color = match ($board['background_color']) {
          'gradient-orange' => 'gradient-orange',
          'gradient-blue' => 'gradient-blue',
          'gradient-green' => 'gradient-green',
          'gradient-red' => 'gradient-red',
          'gradient-pink' => 'gradient-pink',
          'gradient-purple' => 'gradient-purple',
          default => 'darkblue',
        };
      @endphp
      <li class="subdata">
        <a href="{{ route('tasks.index', ['workspace' => $workspace->id, 'board' => $board->id]) }}" id="{{ $board_color }}"
          class="{{ Route::is('tasks.index', ['workspace' => $workspace->id, 'board' => $board->id]) ? 'active' : '' }}">  
          <p>{{ $board->title }}</p>
        </a>
      </li>
    @endif
  @endforeach
  @endforeach
  </ul>
  @foreach ($workspaces as $workspace)
  <ul>
    <li>
      <a href="{{ route('schedule.index', ['workspace' => $workspace->id]) }}" 
        class="{{ Route::is('schedule.index', ['workspace' => $workspace->id]) ? 'active' : '' }}">
        <i class="fa-solid fa-calendar-days"></i>
        <h4>{{ __('Schedule') }}</h4>
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="{{ route('attendance.index', ['workspace' => $workspace->id]) }}" 
        class="{{ Route::is('attendance.index', ['workspace' => $workspace->id]) ? 'active' : '' }}">
        <i class="fa-solid fa-clipboard-user"></i>
        <h4>{{ __('Attendance') }}</h4>
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="{{ route('workspaces.settings', ['workspace' => $workspace->id]) }}" 
        class="{{ Route::is('workspaces.settings', ['workspace' => $workspace->id]) ? 'active' : '' }}">
        <i class="fa-solid fa-gears"></i>
        <h4>{{ __('Settings') }}</h4>
      </a>
    </li>
  </ul>
  <ul>
    <li>
      <a href="{{ route('workspace.archive', ['workspace' => $workspace->id]) }}" 
        class="{{ Route::is('workspace.archive', ['workspace' => $workspace->id]) ? 'active' : '' }}">
        <i class="fa-solid fa-folder-open"></i>
        <h4>{{ __('Archived') }}</h4>
      </a>
    </li>
  </ul>
  @endforeach
  @else
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
    <li class="list-data">
      <a href="{{ route('workspaces.index') }}" class="{{ request()->is('workspace') ? 'active' : '' }}">
        <i class="fa-solid fa-user-group"></i>
        <h4>{{ __('Workspace') }}</h4>
      </a>
    </li>
    @if (auth()->user()->usertype == 'superadmin')
      @foreach ($workspaces as $workspace)
      <li class="subdata">
        <a href="{{ route('workspaces.dashboard', ['workspace' => $workspace->id]) }}"
          class="{{ Route::is('workspaces.dashboard', ['workspace' => $workspace->id]) ? 'active' : '' }}">
          <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon-small" alt="Avatar">
          <p>{{ $workspace->title }}</p>
        </a>
      </li>
      @endforeach
    @else
      @foreach ($workspacesList as $workspace)
      <li class="subdata">
        <a href="{{ route('workspaces.dashboard', ['workspace' => $workspace->workspace->id]) }}"
          class="{{ Route::is('workspaces.dashboard', ['workspace' => $workspace->workspace->id]) ? 'active' : '' }}">
          <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon-small" alt="Avatar">
          <p>{{ $workspace->workspace->title }}</p>
        </a>
      </li>
      @endforeach
    </ul>
    @endif
    @if(auth()->user()->usertype == 'superadmin')
    <ul>
      <li>
        <a href="{{ route('admin.db-user') }}" class="{{ request()->is('db/user') ? 'active' : '' }}">
          <i class="fa-regular fa-id-card"></i>
          <h4>{{ __('User Data') }}</h4>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.db-todo') }}" class="{{ request()->is('db/todo') ? 'active' : '' }}">
          <i class="fa-solid fa-rectangle-list"></i>
          <h4>{{ __('Board Data') }}</h4>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.db-schedule') }}" class="{{ request()->is('db/schedule') ? 'active' : '' }}">
          <i class="fa-solid fa-calendar-day"></i>
          <h4>{{ __('Schedule Data') }}</h4>
        </a>
      </li>
      <li>
        <a href="{{ route('admin.db-attendance') }}" class="{{ request()->is('db/attendance') ? 'active' : '' }}">
          <i class="fa-solid fa-hand"></i>
          <h4>{{ __('Attendance Data') }}</h4>
        </a>
      </li>
      <li>
        <a href="{{ route('logs') }}" class="{{ request()->is('logs') ? 'active' : '' }}">
          <i class="fa-solid fa-clock-rotate-left"></i>
          <h4>{{ __('Activity Logs') }}</h4>
        </a>
      </li>
    </ul>
    @endif
    <ul>
      <li>
        <a href="{{ route('user.archive') }}" class="{{ request()->is('user-archive') ? 'active' : '' }}">
          <i class="fa-solid fa-box-open"></i>
          <h4>{{ __('Archived') }}</h4>
        </a>
      </li>
    </ul>
    <ul>
      <li>
        <a href="{{ route('profile.edit') }}" class="{{ request()->is('profile') ? 'active' : '' }}">
            <i class="fa-solid fa-gamepad"></i>
            <h4>{{ __('Settings') }}</h4>
        </a>
      </li>
    </ul>
  @endif
</div>