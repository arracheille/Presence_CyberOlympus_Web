<x-app-layout>
    <div class="dashboard-attendance-top">
        <h1 class="gradient-text-blue" id="current-time">00:00</h1>
        <h3>{{ \Carbon\Carbon::now()->format('l F j, Y') }}</h3>
      </div>
      <div class="dashboard-attendance-bottom">
        <div class="content-attendance">
          <button class="gradient-h-blue" id="open-checkin-modal">Check In Attendance</button>
          <div class="attendance-warning"><p class="gradient-text-green"><i class="fa-solid fa-circle-exclamation"></i> You Have Checked-In</p></div>
        </div>
        <div class="content-attendance">
          <button class="gradient-h-blue" id="checkout-alert">Check Out Attendance</button>
          <div class="attendance-warning"><p class="gradient-text-red"><i class="fa-solid fa-circle-exclamation"></i> You Haven't Checked-Out</p></div>
        </div>
      </div>
    {{-- <div class="dashboard-presence-top container">
        <h1 id="current-date">Date</h1>
        <h2 id="current-time">Time</h2>
        <div class="dashboard-check-in-out">
            <h4>Check In Time : <span>08:00 - 08:10</span></h4>
            <h4>Check Out Time : <span>17:00 - 07:00</span></h4>
        </div>
    </div>
    <div class="dashboard-presence-bottom">
        <div class="dashboard-presence-bottom-items checkin container">
            <button class="btn" id="open-checkin-modal">Check-In Attendance</button>
            <div class="info-check-in-out">
                <p class="y-check-in-out"><i class="fa-solid fa-circle-exclamation"></i> You Have Checked-in</p>
            </div>
        </div>
        <div class="dashboard-presence-bottom-items checkout container">
            <button class="btn" id="checkout-alert">Check-Out Attendance</button>
            <div class="info-check-in-out">
                <p class="n-check-in-out"><i class="fa-solid fa-circle-exclamation"></i> You Haven't Checked-in</p>
            </div>
        </div>
    </div> --}}
    @include('modals.attendance')
</x-app-layout>