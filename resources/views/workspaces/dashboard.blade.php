<x-app-layout>
    @include('components.css-schedule')
  <div class="dashboard-top">
        <div class="content dashboard-workspace gradient-v-blue">
            <div class="workspace-title">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
                <div class="workspace-title-author">
                    <h3>{{ $workspace->title }}</h3>
                    <h4>Created by: <span>{{ $workspace->user->name }}</span></h4>
                    @if(!is_null($workspace->description) && $workspace->description !== '')
                    <p>{{ $workspace->description }}</p>
                    @endif
                    <p class="text-small">{{ $workspace->type }}</p>
                </div>
            </div>
        </div>
        <div class="content dashboard-workspace gradient-v-green">
            <h4>Share Workspace</h4>
            <div class="task-share">
                <div class="dropdown">
                    <button class="link btn-trans">Share</button>
                    <div class="dropdown-menu ">
                        <div class="dropdown-title-close">
                            <h4>Workspace Link</h4>
                            <span class="close">&times;</span>
                        </div>
                        <div class="result-container">
                            <input type="text" value="{{ $workspace->unique_code }}" class="filter" id="share_url" placeholder="Filter Posts" readonly>
                            <button class="btn ctoCb" id="clipboard">
                                <i class="far fa-clipboard"></i>
                            </button>
                        </div>
                        <p>Or invite user from email</p>
                        <form action="/send-w-code" method="POST">
                            @csrf
                            <input type="hidden" name="unique_code" value="{{ $workspace->unique_code }}">
                            <input type="email" class="input-join" name="email" placeholder="Example: acwel@gmail.com" required>
                            <button type="submit">Send Invitation</button>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
        <div class="content dashboard-workspace">
            <div class="content-item gradient-v-orange">
                <h4>Members: <span>{{ $workspace->members->count() }}</span></h4>
            </div>
            <div class="content-item gradient-v-red">
                <h4>Boards: <span>{{ $workspace->boards->count() }}</span></h4>
            </div>
            <div class="content-item gradient-v-purple">
                <h4>Schedules: <span>{{ $workspace->schedules->count() }}</span></h4>
            </div>
            <div class="content-item gradient-v-pink">
                <h4>Tasks: <span>{{ $workspace->boards->flatMap->tasks->count() }}</span></h4>
            </div>
        </div>
    </div>
    <div class="dashboard-bottom">
        <div class="dashboard-schedule">
            <h3>Weekly Workspace Schedules</h3>
            <div class="dashboard-schedule-container">
                @if($workspace->schedules->isEmpty())
                <p>Nobody created a schedule on this workspace yet!</p>
                @else
                @foreach ($workspace->schedules->where('user_id', auth()->user()->id) as $schedule)
                @php
                $color = match ($schedule['background_color']) {
                    'gradient-orange' => 'gradient-orange',
                    'gradient-blue' => 'gradient-blue',
                    'gradient-green' => 'gradient-green',
                    'gradient-red' => 'gradient-red',
                    'gradient-pink' => 'gradient-pink',
                    'gradient-purple' => 'gradient-purple',
                    default => 'darkblue',
                };
                @endphp
                <div class="content" id="{{ $color }}">
                    <h3>{{ $schedule->title }}</h3>
                    <p>{{ \Carbon\Carbon::parse($schedule->start)->format('l, F j, Y H:i') }} - {{ \Carbon\Carbon::parse($schedule->end)->format('l, F j, Y H:i') }}</p>
                </div>
                @endforeach
            @endif
            </div>
        </div>
        <div class="dashboard-board">
            <h3>Newest Workspace Boards</h3>
            <div class="dashboard-board-container">
                @forelse ($workspace->boards->sortByDesc('created_at')->take(3) as $board)
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
                    <div class="dashboard-board-content" id="{{ $board_color }}">
                        <a href="/board-task/{{ $board->id }}">{{ $board['title'] }}</a>
                    </div>
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
                    <div class="dashboard-board-content" id="{{ $board_color }}">
                        <a href="/board-task/{{ $board->id }}">{{ $board['title'] }}</a>
                    </div>
                @endif
                @empty
                    <p>Nobody created a board on this workspace yet!</p>
                @endforelse
            </div>
        </div>
    </div>
    @include('components.dropdownform')
    @include('components.btn-copy')
    <script>
        var schedules = @json($workspace->schedules);
  </script>
</x-app-layout>