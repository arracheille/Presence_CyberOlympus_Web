@if ($taskitem->taskitem_members->isNotEmpty() && $taskitem->logs->where('user_id', $taskitem->taskitem_members->first()->user_id)->isNotEmpty())
<h4>Taskitem Logs</h4>
@foreach ($taskitem->logs as $log)
    <div class="log-content">
        <img src="https://ui-avatars.com/api/?name={{ urlencode($log->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
        <p>{{ $log->user->name }}</p>
        <p>{{ $log->action }} Task Item</p>
        <p>{{ $log->taskitem->title }}.</p>
    </div>
@endforeach
@else
@endif