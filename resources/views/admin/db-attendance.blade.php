<x-app-layout>
  <head>
    @include('admin.css')
  </head>

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
    <button id="open-checkin-modal" class="gradient-h-blue">Add Data</button>
  </div>
  <table id="db-table" class="admin-table">
    <thead>
      <tr>
        <th class="text-center">ID</th>
        <th>Name</th>
        <th>Option</th>
        <th>Message</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th class="text-center">Actions</th>
      </tr>
    </thead>
    <tbody>
      @if ($attendances->isEmpty())
      <p>No data available.</p>
      @else
      @foreach ($attendances as $attendance)
          <tr>
            <td class="text-center">{{ $attendance->id }}</td>
            <td>{{ $attendance->name }}</td>
            <td>{{ $attendance->check_in }}</td>
            <td>{{ $attendance->check_in_message }}</td>
            <td>{{ $attendance->created_at }}</td>
            <td>{{ $attendance->updated_at }}</td>
            <td class="text-center td-icons">
              <button onclick="editForm({{ $attendance->id }}, '{{ $attendance->name }}', '{{ $attendance->check_in }}', '{{ $attendance->check_in_message }}')"><i class="fa-solid fa-pen"></i></button>
              <button onclick="deleteForm({{ $attendance->id }})"><i class="fa-solid fa-trash"></i></button>
            </td>
          </tr>
        @endforeach
      @endif
    </tbody>
  </table>

  <div id="checkinModal" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
          <h2>Check-In Attendance</h2>    
          <span class="close" id="close-modal">&times;</span>
        </div>
        <form action="/db/attendance" method="POST">
          @csrf
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" placeholder="Input Name">
      
          {{-- <label for="user_list">Or Choose from User:</label>
          <select id="user_list" name="name">
            <option value="">Choose User</option>
            @foreach ($users as $user)
                <option value="{{ $user->name }}">{{ $user->name }}</option>
            @endforeach
          </select> --}}
      
          <label for="check_in">Status:</label>
          <select id="check_in" name="check_in">
            <option value="Present">Present</option>
            <option value="Sick">Sick</option>
            <option value="Absent">Absent</option>
          </select>
      
          <label for="check_in_message" id="check_in_message_label">Message:</label>
          <textarea id="check_in_message" name="check_in_message" placeholder="Example: Fever"></textarea>
      
          <div class="modal-footer">
            <button type="submit" class="submit-btn" id="modal-submit-btn">Submit</button>
          </div>
        </form>
    </div>
  </div>

  <div id="edit-form" class="modal">
    <div class="modal-content">
      <div class="modal-title-close">
        <h2>Edit Attendance</h2>    
        <span class="close" onclick="closeEdit()">&times;</span>
      </div>
      <form id="editForm" action="" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="editId" name="id">

        <label for="editName">Name:</label>
        <input type="text" id="editName" name="name" required>

        <label for="editStatus">Option:</label>
        <select id="editStatus" name="check_in" required>
          <option value="Present">Present</option>
          <option value="Sick">Sick</option>
          <option value="Absent">Absent</option>
        </select>

        <label for="editmessage" id="editmessage_label">Message:</label>
        <textarea id="editmessage" name="check_in_message"></textarea>        

        <div class="modal-footer">
          <button type="submit" class="submit-btn">Update</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    let table = new DataTable('#db-table');

    function editForm(id, name, check_in, check_in_message) {
      document.getElementById('editId').value = id;
      document.getElementById('editName').value = name;
      document.getElementById('editStatus').value = check_in;
      document.getElementById('editmessage').value = check_in_message;
      document.getElementById('editForm').action = `/db/attendance/update/${id}`;
      document.getElementById('edit-form').style.display = 'block';
    }

    function closeEdit() {
      document.getElementById('edit-form').style.display = 'none';
    }

    function deleteForm(id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`delete-form-${id}`).submit();
        }
      });
    }
  </script>
  @foreach ($attendances as $attendance)
    <form id="delete-form-{{ $attendance->id }}" action="/db/attendance/delete/{{ $attendance->id }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
  @endforeach
  <script src="{{ asset('js/modalcheck.js') }}"></script>
</x-app-layout>
