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
@endif