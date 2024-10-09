<div class="dropdown">
    <button class="link">Due Date</button>
    <div class="dropdown-menu background">
        <div class="dropdown-title-close">
            <h4>Task Due Date</h4>
            <span class="close">&times;</span>
        </div>
        @if ($taskitem->schedules->where('task_item_id', $taskitem->id)->isEmpty())
            <form action="/schedule-component-create" method="POST">
                @csrf
                <input type="text" id="title" name="title" value="{{ $taskitem->title }}" style="display: none">
                <input type="hidden" name="workspace_id" value="{{ $taskitem->tasks->board->workspace->id }}">
                <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                <input type="hidden" value="gradient-blue" name="background_color">
                <input type="datetime-local" id="start-date" name="start" style="display: none">
                <input type="datetime-local" id="end-date" name="end">
                <button type="submit">Save</button>
            </form>
        @else
            @foreach ($taskitem->schedules as $schedule)
                <form action="/schedule-edit/{{ $schedule->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="text" id="title" name="title" value="{{ $taskitem->title }}" style="display: none">
                    <input type="hidden" value="gradient-blue" name="background_color">
                    <input type="datetime-local" id="start-date" name="start" style="display: none">
                    <input type="datetime-local" name="end" value="{{ $schedule->end }}">
                    <button type="submit">Submit</button>
                </form>
            @endforeach
        @endif
    </div>
</div>