<x-app-layout>
  @include('components.css-schedule')
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
                if ($schedule['background_color'] == 'gradient-orange') {
                $color = "gradient-orange";
                }elseif ($schedule['background_color'] == 'gradient-blue') {
                $color = "gradient-blue";
                }elseif ($schedule['background_color'] == 'gradient-green') {
                $color = "gradient-green";
                }elseif ($schedule['background_color'] == 'gradient-red') {
                $color = "gradient-red";
                }elseif ($schedule['background_color'] == 'gradient-pink') {
                $color = "gradient-pink";
                }elseif ($schedule['background_color'] == 'gradient-purple') {
                $color = "gradient-purple";
                }else{
                $color = "darkblue";
                }
              @endphp
              <div class="content" id="{{ $color }}">
                <h3>{{ $schedule->title }}</h3>
                <p>{{ \Carbon\Carbon::parse($schedule->start)->format('l, F j, Y H:i') }} - {{ \Carbon\Carbon::parse($schedule->end)->format('l, F j, Y H:i') }}</p>
              </div>
              @endforeach
          @endif
          </div>
      </div>
      <div class="dashboard-task">
        <h3>Your Tasks</h3>
      </div>
    </div>
    <script>
      var schedules = @json($schedules);
  </script>
</x-app-layout>
