<x-app-layout>
  {{-- @include('components.css-schedule') --}}
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
        <h3>Your Weekly Schedules</h3>
          <div class="dashboard-schedule-container">
            @if($schedules->isEmpty())
              <p>No schedules</p>
          @else
              @foreach ($schedules as $schedule)
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
        <h3>Your Board</h3>
        <div class="dashboard-board-container">
          @if ($boards->isEmpty())
              <p>You haven't created a board yet!</p>
          @else 
          @foreach ($boards as $board)
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
          @endforeach
          @endif
        </div>
      </div>
    </div>
    <script>
      var schedules = @json($schedules);
  </script>
</x-app-layout>
