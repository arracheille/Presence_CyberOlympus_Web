<script src="{{ asset('fullcalendar-6.1.15/dist/index.global.js') }}"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");

    var today = new Date();
    var formattedToday = today.toISOString().slice(0, 10);

    var calendar = new FullCalendar.Calendar(calendarEl, {
      headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay",
      },
      initialDate: formattedToday,
      navLinks: true,
      selectable: true,
      selectMirror: true,
      select: function (arg) {
        var startDate = new Date(arg.startStr);
        var endDate = new Date(arg.endStr);
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
      events: @json($schedules),
      eventDidMount: function(info) {
        var backgroundColorId = info.event.extendedProps.background_color;
        if (backgroundColorId) {
            info.el.id = backgroundColorId;
        }
      }
    });
    calendar.render();
  });
</script>
