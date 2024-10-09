@if ($taskitem->schedules->isEmpty())
@else
    <label for="">Due Date</label>
    @foreach ($taskitem->schedules as $schedule)
    <div class="modal-details-due-date">
        <div class="due-date-container">
            <form action="/schedule-edit/{{ $schedule->id }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="title" name="title" value="{{ $taskitem->title }}" style="display: none">
                <input type="hidden" value="gradient-blue" name="background_color">
                <input type="datetime-local" id="start-date" name="start" style="display: none">
                <input type="datetime-local" name="end" value="{{ $schedule->end }}">
            </form>
        </div>
    </div>
    @endforeach
@endif