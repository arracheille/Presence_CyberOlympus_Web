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
    <h2>Attendance Data</h2>
  </div>

  <div class="wrapper">
    <div class="dashboard-db-user">
      @if ($users->isEmpty())
          <p>No data available.</p>
      @else
        <table class="admin-table">
          <thead>
            <tr>
              <th class="text-center">#</th>
              <th class="text-center">User ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Usertype</th>
              <th>Email Verified At</th>
              <th>Password</th>
              <th>Remember Token</th>
              <th>Created At</th>
              <th>Updated At</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($users as $user)
                <tr>
                  <td class="text-center">{{ $loop->iteration }}</td>
                  <td class="text-center">{{ $user->id }}</td>
                  <td>
                    @if (auth()->user()->usertype == 'superadmin')
                      <a href="/user-details/{{ $user->id }}">
                        <p style="text-decoration: underline">{{ $user->name }}</p>
                      </a>
                    @else
                      {{ $user->name }}
                    @endif
                  </td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->usertype }}</td>
                  <td>{{ $user->email_verified_at }}</td>
                  <td>{{ $user->password }}</td>
                  <td>{{ $user->remember_token }}</td>
                  <td>{{ $user->created_at }}</td>
                  <td>{{ $user->updated_at }}</td>
                  <td class="text-center td-icons">
                  <form id="delete-user-{{ $user->id }}" action="/db/user/delete/{{ $user->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="delete-btn" onclick="confirmDelete('delete-user-{{ $user->id }}')"><i class="fa-solid fa-trash"></i></button>
                  </form>
                  </td>
                </tr>
              @endforeach
          </tbody>
        </table>
      @endif  
    </div>
  </div>

  <script>
    function confirmDelete(formId) {
    const form = document.getElementById(formId);
      Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    }
  </script>
  {{-- <script src="{{ asset('js/modalcheck.js') }}"></script> --}}
</x-app-layout>
