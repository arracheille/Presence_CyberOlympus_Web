<script src="{{ asset('fullcalendar-6.1.15/dist/index.global.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");

    var today = new Date();
    var formattedToday = today.toISOString().slice(0, 10);

    var startRange = new Date(today);
    startRange.setDate(today.getDate() - 3);

    var endRange = new Date(today);
    endRange.setDate(today.getDate() + 3);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: false,
      initialView: 'dayGridWeek',
      initialDate: formattedToday,
      visibleRange: {
        start: startRange.toISOString().slice(0, 10),
        end: endRange.toISOString().slice(0, 10),
      },
      navLinks: false,
      selectable: true,
      selectMirror: true,
      select: function (arg) {
        var startDate = new Date(arg.startStr);
        var endDate = new Date(startDate);

        endDate.setDate(startDate.getDate() + 1);

        var hours = startDate.getHours();
        var minutes = startDate.getMinutes();

        startDate.setHours(hours, minutes);
        endDate.setHours(hours, minutes);

        var startDateString = startDate.toISOString().slice(0, 16);
        var endDateString = endDate.toISOString().slice(0, 16);

        document.getElementById('start-date').value = startDateString;
        document.getElementById('end-date').value = endDateString;

        openAddschedule();
        calendar.unselect();
      },
      eventClick: function (arg) {
        var scheduleId = arg.event.id;
        openEditschedule(scheduleId);
      },
      editable: false,
      dayMaxEvents: true,
      events: @json($workspace->schedules),
      eventDidMount: function(info) {
        var backgroundColorId = info.event.extendedProps.background_color;
        if (backgroundColorId) {
          info.el.id = backgroundColorId;
        }
      },
      dayHeaderFormat: { weekday: 'short' } // Format singkat untuk hari
    });
    
    calendar.render();
  });
</script>
