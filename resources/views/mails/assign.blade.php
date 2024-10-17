<h2>You Are Assigned to this task item</h2>

<p>{{ $taskitem->title }}</p>

<a href="{{ route('tasks.index', ['workspace' => $workspace->id, 'board' => $board->id]) }}" 
    style="display: inline-block; padding: 10px 20px; color: white; background-color: #2929cc; text-decoration: none; border-radius: 5px;">
    Accept Invitation
 </a>
 