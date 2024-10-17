@if ($taskitem->taskitem_members->isNotEmpty() && $taskitem->logs->where('user_id', $taskitem->taskitem_members->first()->user_id)->isNotEmpty())
<h4>Logs</h4>
@foreach ($taskitem->logs as $log)
    <div class="log-content">
        <p>{{ $log->user->name }}</p>
        <p>{{ $log->action }}</p>
        {{-- <p>{{ $log->taskitem->title }}</p> --}}
    </div>
@endforeach
@else
@endif