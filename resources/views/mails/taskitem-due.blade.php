<h2>The following schedules are almost due!</h2>
<ul>
    @foreach ($due_dates->taskitems as $taskitem)
        <li>
            <a href="{{ route('taskitem.index', ['workspace' => $taskitem->tasks->board->workspace->id, 'id' => $taskitem->id]) }}">{{ $taskitem->title }}</a>
                is almost due!
        </li>
    @endforeach
</ul>
<p>Please finish these tasks immediately!</p>