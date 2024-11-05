<div class="dropdown">
    <button class="link">Due Date</button>
    <div class="dropdown-menu background">
        <div class="dropdown-title-close">
            <h4>Task Due Date</h4>
            <span class="close">&times;</span>
        </div>
        @if ($taskitem->due_dates->where('task_item_id', $taskitem->id)->isEmpty())
            <form action="/due-date-create" method="POST">
                @csrf
                <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                <input type="datetime-local" id="end-date" name="due_at">
                <button type="submit">Save</button>
            </form>
        @else
            @foreach ($taskitem->due_dates as $due_date)
                <form action="/due-date-edit/{{ $due_date->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="datetime-local" name="due_at" value="{{ $due_date->due_at }}">
                    <button type="submit">Submit</button>
                </form>
            @endforeach
        @endif
    </div>
</div>