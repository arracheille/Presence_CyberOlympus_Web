<h2>The following schedules are almost due!</h2>
<ul>
    @foreach ($schedules as $schedule)
        <li><span style="font-weight: 600">{{ $schedule->title }}</span> is almost due!</li>
    @endforeach
</ul>
<a href="/dashboard"
    style="display: inline-block; padding: 10px 20px; color: white; background-color: #2929cc; text-decoration: none; border-radius: 5px;">
    View Schedule
</a>
<h5>Please finish these schedules immediately!</h5>
