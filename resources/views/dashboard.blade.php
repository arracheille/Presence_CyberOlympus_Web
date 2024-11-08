<x-app-layout>
  @include('components.weekly-schedule')
  <div class="dashboard-top">
      <div class="content gradient-v-orange">
        <button class="btn-trans">Check-In Attendance</button>
        <button class="btn-trans">Check-Out Attendance</button>
      </div>
      <div class="content gradient-v-blue">
        <h2 id="current-time">00:00</h2>
        <h4>Wednesday, 8 September 2024</h4>
      </div>
      <div class="content gradient-v-green">
        <h3>{{ Auth::user()->name }}</h3>
        <p>{{ Auth::user()->email }}</p>
        <p>{{ Auth::user()->usertype }}</p>
        <a href="{{ route('profile.edit') }}" class="btn-trans btn-small">Edit</a>
      </div>
    </div>
    <div class="dashboard-bottom">
      <div class="dashboard-schedule">
        <h3>Your Newest Weekly Schedules</h3>
        @if($schedules->isEmpty())
          <p>No schedules</p>
        @else
          <div id="calendar"></div>
        @endif
      </div>
      <div class="dashboard-board">
        <h3>Your Newest Boards</h3>
        <div class="dashboard-board-container">
          @forelse ($boards->sortByDesc('created_at')->take(3) as $board)
          @if ($board->user_id === auth()->user()->id)
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
            <p>You haven't created a board yet!</p>
          @endforelse
        </div>
      </div>
    </div>
    <script>
      var schedules = @json($schedules);
  </script>
</x-app-layout>
