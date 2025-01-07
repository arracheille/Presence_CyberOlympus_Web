<x-app-layout>
    <div class="attendance-records-container">
        <div class="attendance-records-content gradient-h-green">
            <h3><i class="fa-solid fa-user-check"></i></h3>
            <div class="attendance-records-text">
                <h4>Present</h4>
                <h2>00</h2>
            </div>
        </div>
        <div class="attendance-records-content gradient-h-orange">
            <h3><i class="fa-solid fa-clock"></i></h3>
            <div class="attendance-records-text">
                <h4>Late</h4>
                <h2>00</h2>
            </div>
        </div>
        <div class="attendance-records-content gradient-h-blue">
            <h3><i class="fa-solid fa-stethoscope"></i></h3>
            <div class="attendance-records-text">
                <h4>Sick</h4>
                <h2>00</h2>
            </div>
        </div>
        <div class="attendance-records-content gradient-h-red">
            <h3><i class="fa-solid fa-triangle-exclamation"></i></h3>
            <div class="attendance-records-text">
                <h4>Absent</h4>
                <h2>00</h2>
            </div>
        </div>
    </div>
    <div class="attendance-location">
        <h4>Locations</h4>
        @if ($workspace->locations->isEmpty())
            <p>The admin haven't set a location yet!</p>
            @if (auth()->user()->id == $workspace->user_id && $workspace->members->where('role', 'admin')->isNotEmpty())
                <a href="{{ route('maps.index', ['workspace' => $workspace->id]) }}" class="btn">Set Location</a>
            @endif
        @else
            @foreach ($workspace->locations as $location)
                <p>Location Address: <a href="{{ route('maps.edit', ['workspace' => $workspace->id, 'location' => $location->id]) }}">{{ $location->name }}</a></p>
            @endforeach
            @if (auth()->user()->id == $workspace->user_id && $workspace->members->where('role', 'admin')->isNotEmpty())
                <a href="{{ route('maps.edit', ['workspace' => $workspace->id, 'location' => $location->id]) }}" class="btn">Edit Location</a>
            @endif
        @endif
        </div>
    <div class="attendance-history">
        <div class="attendance-info-container">
            @foreach ($workspaces as $workspace)
            <div class="attendance-info-content">
                <div class="attendance-info-icon gradient-v-green">
                    <h4><i class="fa-solid fa-right-to-bracket"></i></h4>
                </div>
                <h4>Check-In</h4>
                <p>
                    @if ($workspace->infos->isEmpty())
                        No time set
                    @else
                        @foreach ($workspace->infos as $info)
                            {{ $info->min_check_in }} - {{ $info->max_check_in }}
                        @endforeach
                    @endif
                </p>
            </div>
            <div class="attendance-info-content">
                <div class="attendance-info-icon gradient-v-orange">
                    <h4><i class="fa-solid fa-right-from-bracket"></i></h4>
                </div>
                <h4>Check-Out</h4>
                <p>
                    @if ($workspace->infos->isEmpty())
                        No time set
                    @else
                        @foreach ($workspace->infos as $info)
                            {{ $info->min_check_out }} - {{ $info->max_check_out }}
                        @endforeach
                    @endif
                </p>
            </div>
        
            <div class="attendance-info-content">
                <div class="attendance-info-icon gradient-v-blue">
                    <h4><i class="fa-solid fa-play"></i></h4>
                </div>
                <h4>Break-In</h4>
                <p>
                    @if ($workspace->infos->isEmpty())
                        No time set
                    @else
                        @foreach ($workspace->infos as $info)
                            {{ $info->min_break_in }} - {{ $info->max_break_in }}
                        @endforeach
                    @endif
                </p>
            </div>
        
            <div class="attendance-info-content">
                <div class="attendance-info-icon gradient-v-red">
                    <h4><i class="fa-solid fa-pause"></i></h4>
                </div>
                <h4>Break-Out</h4>
                <p>
                    @if ($workspace->infos->isEmpty())
                        No time set
                    @else
                        @foreach ($workspace->infos as $info)
                            {{ $info->min_break_out }} - {{ $info->max_break_out }}
                        @endforeach
                    @endif
                </p>
            </div>
        @endforeach
        </div>
        <div class="user-attendance-filter">
            @if (auth()->user()->id == $workspace->user_id && $workspace->members->where('role', 'admin')->isNotEmpty())
                <div class="attendance-admin-buttons">
                    @if ($workspace->infos->isEmpty())
                        <button class="add-info gradient-h-blue" onclick="openAddInfo()">Set Status Time</button>
                    @else
                        @foreach ($workspace->infos as $info)
                        <button class="add-info gradient-h-blue" onclick="openEditInfo({{ $info->id }})">Edit Status Time</button>        
                        @endforeach
                    @endif        
                    <button class="add-attendance gradient-h-blue" onclick="openAddAttendance()">Add Member Attendance</button>
                </div>
            @endif
            <div class="dropdown">
                <button class="link gradient-h-blue">Filter Table</button>
                <div class="dropdown-menu label-modal dropdown-color">
                    <div class="dropdown-title-close">
                        <h4>Filter Task & Task Item</h4>
                        <span class="close">&times;</span>
                    </div>
                    <div class="filter-item bytext color-container">
                        <h5>Filter by date</h5>
                        <input type="text" name="search" placeholder="Search...">
                    </div>
                </div>
            </div>
        </div>
        <table class="user-attendance-table">
            <tr>
                <th>Username</th>
                <th>DateTime</th>
                <th>At</th>
                <th>Status</th>
            </tr>
            @foreach ($workspace->attendances as $attendance)
            <tr>
                    <td>{{ $attendance->users->name }}</td>
                    <td>{{ $attendance->created_at }}</td>
                    <td>{{ $attendance->attendance_at }}</td>
                    <td>{{ $attendance->status }}</td>
            </tr>
            @endforeach
        </table>
    </div>
    <div id="addlocationModal" class="modal">
        <div class="modal-content">
            <div class="modal-title-close">
                <h3>Add New Location</h3>
                <span class="close" onclick="closeAddLocation()">&times;</span>
            </div>
            <form action="/create-attendance-location" method="POST">
                @csrf
                <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
                <label for="location_name">Location Name</label>
                <input type="text" name="location_name" id="location_name" placeholder="Example: Office, Home, etc...">
                <label for="location">Location (Google Maps)</label>
                <input type="text" name="location" id="location" placeholder="Example: https://maps.app.goo.gl/...">
                <div class="modal-footer">
                    <button class="submit-btn" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div id="addinfoModal" class="modal">
        <div class="modal-content">
            <div class="modal-title-close">
                <h3>Set Status Time</h3>
                <span class="close" onclick="closeAddInfo()">&times;</span>
            </div>
            <form action="/create-attendance-info" method="POST">
                @csrf
                <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">

                <label for="check_in">Check-In Time:</label>
                <div class="min-max-input">
                    <input type="time" id="min_check_in" name="min_check_in" required>
                    <p>to</p>
                    <input type="time" id="max_check_in" name="max_check_in" required>
                </div>
            
                <label for="check_out">Check-Out Time:</label>
                <div class="min-max-input">
                    <input type="time" id="min_check_out" name="min_check_out" required>
                    <p>to</p>
                    <input type="time" id="max_check_out" name="max_check_out" required>
                </div>
            
                <label for="break_in">Break-In Time:</label>
                <div class="min-max-input">
                    <input type="time" id="min_break_in" name="min_break_in" required>
                    <p>to</p>
                    <input type="time" id="max_break_in" name="max_break_in" required>
                </div>
            
                <label for="break_out">Break-Out Time:</label>
                <div class="min-max-input">
                    <input type="time" id="min_break_out" name="min_break_out" required>
                    <p>to</p>
                    <input type="time" id="max_break_out" name="max_break_out" required>
                </div>
            
                <div class="modal-footer">
                    <button class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    @foreach ($workspace->infos as $info)
    <div id="editinfoModal{{ $info->id }}" class="modal">
        <div class="modal-content">
            <div class="modal-title-close">
                <h3>Edit Status Time</h3>
                <span class="close" onclick="closeAddInfo()">&times;</span>
            </div>
            <form action="/edit-attendance-info/{{ $info->id }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="editInfoid-{{ $info->id }}" name="id">

                <label for="check_in">Check-In Time:</label>
                <div class="min-max-input">
                    <input type="time" id="min_check_in" name="min_check_in" value="{{ $info->min_check_in }}" required>
                    <p>to</p>
                    <input type="time" id="max_check_in" name="max_check_in" value="{{ $info->max_check_in }}" required>
                </div>
            
                <label for="check_out">Check-Out Time:</label>
                <div class="min-max-input">
                    <input type="time" id="min_check_out" name="min_check_out" value="{{ $info->min_check_out }}" required>
                    <p>to</p>
                    <input type="time" id="max_check_out" name="max_check_out" value="{{ $info->max_check_out }}" required>
                </div>
            
                <label for="break_in">Break-In Time:</label>
                <div class="min-max-input">
                    <input type="time" id="min_break_in" name="min_break_in" value="{{ $info->min_break_in }}" required>
                    <p>to</p>
                    <input type="time" id="max_break_in" name="max_break_in" value="{{ $info->max_break_in }}" required>
                </div>
            
                <label for="break_out">Break-Out Time:</label>
                <div class="min-max-input">
                    <input type="time" id="min_break_out" name="min_break_out" value="{{ $info->min_break_out }}" required>
                    <p>to</p>
                    <input type="time" id="max_break_out" name="max_break_out" value="{{ $info->max_break_out }}" required>
                </div>
            
                <div class="modal-footer">
                    <button class="submit-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
    <div id="addAttendanceModal" class="modal">
        <div class="modal-content">
            <div class="modal-title-close">
                <h3>Add New Location</h3>
                <span class="close" onclick="closeAddAttendance()">&times;</span>
            </div>
            <form action="/create-attendance" method="POST">
                @csrf
                <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
                <label for="user_id">Username</label>
                <select name="user_id" id="user_id">
                    @foreach ($workspaces as $workspace)
                        @foreach($workspace->members as $member)
                            <option value="{{ $member->user->id }}"> {{ $member->user->name }} </option>
                        @endforeach
                    @endforeach
                </select>
                <label for="attendance_at">Attendance At</label>
                <select name="attendance_at" id="attendance_at">
                    <option value="check_in">Check-In</option>
                    <option value="check_out">Check-Out</option>
                    <option value="break_in">Break-In</option>
                    <option value="break_out">Break-Out</option>
                </select>
                <label for="status">Attendance Status</label>
                <select name="status" id="status">
                    <option value="present">Present</option>
                    <option value="late">Late</option>
                    <option value="sick">Sick</option>
                    <option value="absent">Absent</option>
                </select>
                <div class="modal-footer">
                    <button class="submit-btn" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function openAddLocation() {
            document.getElementById('addlocationModal').style.display = 'block';
        }

        function closeAddLocation() {
            document.getElementById('addlocationModal').style.display = 'none';
        }

        function openAddInfo() {
            document.getElementById('addinfoModal').style.display = 'block';
        }

        function closeAddInfo() {
            document.getElementById('addinfoModal').style.display = 'none';
        }

        function openEditInfo(id) {
            document.getElementById('editinfoModal' + id).style.display = 'block';
            document.getElementById('editInfoid-' + id).value = id;
        }

        // function openEdittask(id) {
        //     document.getElementById('editTaskModal-' + id).style.display = 'block';
        //     document.getElementById('editTaskid-' + id).value = id;
        // }

        function closeEditInfo(id) {
            document.getElementById('editinfoModal' + id).style.display = 'none';
        }

        function openAddAttendance() {
            document.getElementById('addAttendanceModal').style.display = 'block';
        }

        function closeAddAttendance() {
            document.getElementById('addAttendanceModal').style.display = 'none';
        }
    </script>
</x-app-layout>