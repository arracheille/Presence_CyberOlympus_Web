<h2>The following schedules are almost due!</h2>
<ul>
    @foreach ($taskitems as $taskitem)
        <li>
            <a href="{{ route('tasks.index', ['workspace' => $taskitem->tasks->board->workspace->id, 'board' => $taskitem->tasks->board->id, 'id' => $taskitem->id]) }}">{{ $taskitem->title }}</a>
                is almost due!
        </li>
    @endforeach
</ul>
<p>Please finish these tasks immediately!</p>