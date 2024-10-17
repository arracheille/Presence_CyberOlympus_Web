<x-app-layout>
    @include('components.css-schedule')
    <div class="schedule">
        <div class="schedule-title">
            <h2>Workspace Schedules</h2>
            <p>From workspace <strong>{{ $workspace->title }}</strong></p>
        </div>
        <div id="calendar"></div>
      </div>
    @foreach ($workspace->schedules as $schedule)
    <div id="editscheduleModal-{{ $schedule->id }}" class="modal">
        <div class="modal-content">
            <div class="modal-title-close">
                <h2>Schedule Details</h2>
                <span class="close" onclick="closeEditschedule({{ $schedule->id }})">&times;</span>
            </div>
            <p>Created By <span>{{ $schedule->user->name }}</span></p>
            <form action="/schedule-edit/{{ $schedule->id }}" method="POST">
                @csrf
                @method('PUT')
                <label for="start">Start Date</label>
                <input type="datetime-local" name="start" value="{{ $schedule->start }}">
                <label for="end">End Date</label>
                <input type="datetime-local" name="end" value="{{ $schedule->end }}">
                <label for="title">Title :</label>
                <input type="text" name="title" value="{{ $schedule->title }}" placeholder="Example : Meeting With Company A">
                <h4>Choose Background Color</h4>
                <div class="grid-color">
                    <input type="radio" id="option-task-item-label-1-{{ $schedule->id }}" name="background_color" value="gradient-orange"
                        @if($schedule->background_color == 'gradient-orange') checked @endif />
                    <label for="option-task-item-label-1-{{ $schedule->id }}" class="radio-button color" id="gradient-orange"></label>
                    
                    <input type="radio" id="option-task-item-label-2-{{ $schedule->id }}" name="background_color" value="gradient-red"
                        @if($schedule->background_color == 'gradient-red') checked @endif />
                    <label for="option-task-item-label-2-{{ $schedule->id }}" class="radio-button color" id="gradient-red"></label>
                    
                    <input type="radio" id="option-task-item-label-3-{{ $schedule->id }}" name="background_color" value="gradient-blue"
                        @if($schedule->background_color == 'gradient-blue') checked @endif />
                    <label for="option-task-item-label-3-{{ $schedule->id }}" class="radio-button color" id="gradient-blue"></label>
                    
                    <input type="radio" id="option-task-item-label-4-{{ $schedule->id }}" name="background_color" value="gradient-green"
                        @if($schedule->background_color == 'gradient-green') checked @endif />
                    <label for="option-task-item-label-4-{{ $schedule->id }}" class="radio-button color" id="gradient-green"></label>
                    
                    <input type="radio" id="option-task-item-label-5-{{ $schedule->id }}" name="background_color" value="gradient-pink"
                        @if($schedule->background_color == 'gradient-pink') checked @endif />
                    <label for="option-task-item-label-5-{{ $schedule->id }}" class="radio-button color" id="gradient-pink"></label>
                    
                    <input type="radio" id="option-task-item-label-6-{{ $schedule->id }}" name="background_color" value="gradient-purple"
                        @if($schedule->background_color == 'gradient-purple') checked @endif />
                    <label for="option-task-item-label-6-{{ $schedule->id }}" class="radio-button color" id="gradient-purple"></label>
                </div>
                <button type="submit" class="submit-btn">Submit</button>
            </form>
            <form action="/schedule-delete/{{ $schedule->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Archive</button>
            </form>
        </div>
    </div>
    @endforeach
    <div id="addscheduleModal" class="modal">
        <div class="modal-content">
            <div class="modal-title-close">
                <h2>Add Schedule</h2>
                <span class="close" onclick="closeAddschedule()">&times;</span>
            </div>
            <form action="/schedule-create" method="POST">
                @csrf
                <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
                <label for="start">Start Date</label>
                <input type="datetime-local" id="start-date" name="start" required>
                <label for="end">End Date</label>
                <input type="datetime-local" id="end-date" name="end" required>
                <label for="title">Title :</label>
                <input type="text" name="title" placeholder="Example : Meeting With Company A">
                <h4>Choose Background Color</h4>
                <div class="grid-color">
                    <input type="radio" id="option-task-item-label-1" name="background_color" value="gradient-orange" checked/>
                    <label for="option-task-item-label-1" class="radio-button color" id="gradient-orange"></label>
                    <input type="radio" id="option-task-item-label-2" name="background_color" value="gradient-red" />
                    <label for="option-task-item-label-2" class="radio-button color" id="gradient-red"></label>
                    <input type="radio" id="option-task-item-label-3" name="background_color" value="gradient-blue" />
                    <label for="option-task-item-label-3" class="radio-button color" id="gradient-blue"></label>
                    <input type="radio" id="option-task-item-label-4" name="background_color" value="gradient-green" />
                    <label for="option-task-item-label-4" class="radio-button color" id="gradient-green"></label>
                    <input type="radio" id="option-task-item-label-5" name="background_color" value="gradient-pink" />
                    <label for="option-task-item-label-5" class="radio-button color" id="gradient-pink"></label>
                    <input type="radio" id="option-task-item-label-6" name="background_color" value="gradient-purple" />
                    <label for="option-task-item-label-6" class="radio-button color" id="gradient-purple"></label>
                </div>
                <button class="submit-btn">Submit</button>
            </form>
        </div>
    </div>

    <script>
        var schedules = @json($workspace->schedules);

        function openAddschedule(date) {
            document.getElementById('addscheduleModal').style.display = 'block';
        }

        function closeAddschedule() {
            document.getElementById('addscheduleModal').style.display = 'none';
        }

        function openEditschedule(id) {
            document.getElementById('editscheduleModal-' + id).style.display = 'block';
        }

        function closeEditschedule(id) {
            document.getElementById('editscheduleModal-' + id).style.display = 'none';
        }
    </script>
</x-app-layout>    