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
        console.log(arg.startStr);
        var startDate = new Date(arg.startStr);
        var endDate = new Date(startDate);

        endDate.setDate(startDate.getDate() + 1);

        var hours = startDate.getHours();
        var minutes = startDate.getMinutes();

        startDate.setHours(hours, minutes);
        endDate.setHours(hours, minutes);

        var startDateString = startDate.toISOString().slice(0, 16);
        var endDateString = endDate.toISOString().slice(0, 16);

        document.getElementById('start-date').value = startDate.toISOString().slice(0, 16);
        document.getElementById('end-date').value = endDate.toISOString().slice(0, 16);

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
      }
    });
    calendar.render();
  });
</script>

