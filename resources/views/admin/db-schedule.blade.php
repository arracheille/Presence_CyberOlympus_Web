<x-app-layout>
  @include('admin.css')
  @include('components.css-schedule')
  <h3>Schedule Data</h3>
  <div class="filters">
    <form>
      <input type="text" id="filter-board-task" name="filter-board-task" placeholder="Search..." />

      <button type="submit">Filter</button>
    </form>
  </div>
  <div class="db-calendar">
    <table class="admin-table">
      <thead>
        <tr>
          <th class="text-center">ID</th>
          <th>Username</th>
          <th>Schedule Title</th>
          <th>Start</th>
          <th>End</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($schedules as $schedule)
            <tr>
              <td class="text-center">{{ $schedule->id }}</td>
              <td>{{ $schedule->user->name }}</td>
              <td>{{ $schedule->title }}</td>
              <td>{{ $schedule->start }}</td>
              <td>{{ $schedule->end }}</td>
            </tr>
          @endforeach
      </tbody>
    </table>
  </div>
</x-app-layout>