<x-app-layout>
    @include('admin.css')
    @if ($errors->any())
    <div>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="dashboard-crud">
    <h2>User Logs</h2>
  </div>

  <div class="wrapper">
    <div class="dashboard-db-user">
      @if ($logs->isEmpty())
          <p>No data available.</p>
      @else
        <table class="admin-table">
          <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Description</th>
                <th>Subject Type</th>
                <th>Event</th>
                <th>Subject Id</th>
                <th>Properties</th>
                <th>Created At</th>
                <th>Updated At</th>
                </tr>
          </thead>
          <tbody>
            @foreach($logs as $log)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if ($log->causer)
                        {{ $log->causer->name }}
                    @else
                        <p>Guest</p>
                    @endif
                </td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->subject_type }}</td>
                <td>{{ $log->event }}</td>
                <td>{{ $log->subject_id }}</td>
                <td>{{ $log->properties }}</td>
                <td>{{ $log->created_at }}</td>
                <td>{{ $log->updated_at }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif  
    </div>
  </div>
</x-app-layout>