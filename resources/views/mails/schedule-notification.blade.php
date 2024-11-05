<h2>The following schedules are almost due!</h2>
<ul>
    @foreach ($schedules as $schedule)
        <li>
            <a href="{{ route('schedule.index', ['workspace' => $schedule->workspace_id, 'id' => $schedule->id]) }}">{{ $schedule->title }}</a>
                is almost due!
        </li>
    @endforeach
</ul>
<p>Please finish these tasks immediately!</p>