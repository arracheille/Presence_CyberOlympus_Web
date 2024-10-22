@if ($taskitem->due_dates->isEmpty())
@else
    <label for="">Due Date</label>
    @foreach ($taskitem->due_dates as $due_date)
    <div class="modal-details-due-date">
        <div class="due-date-container">
            <form action="/due-date-edit/{{ $due_date->id }}" method="POST">
                @csrf
                @method('PUT')
                @if (\Carbon\Carbon::parse($due_date->due_at)->lt(\Carbon\Carbon::now()))
                <input type="datetime-local" name="end" value="{{ $due_date->due_at }}">
                <p class="text-small">This task is overdue</p>
                @else
                <input type="datetime-local" name="end" value="{{ $due_date->due_at }}">
                @endif
            </form>
        </div>
    </div>
    @endforeach
    {{-- @foreach ($taskitem->schedules as $schedule)
    <div class="modal-details-due-date">
        <div class="due-date-container">
            <form action="/schedule-edit/{{ $schedule->id }}" method="POST">
                @csrf
                @method('PUT')
                <input type="text" id="title" name="title" value="{{ $taskitem->title }}" style="display: none">
                <input type="hidden" value="gradient-blue" name="background_color">
                <input type="datetime-local" id="start-date" name="start" style="display: none">
                @if (\Carbon\Carbon::parse($schedule->end)->lt(\Carbon\Carbon::now()))
                <input type="datetime-local" name="end" value="{{ $schedule->end }}" id="overdue">
                <p class="text-small">This task is overdue</p>
                @else
                <input type="datetime-local" name="end" value="{{ $schedule->end }}">
                @endif
            </form>
        </div>
    </div>
    @endforeach --}}
@endif