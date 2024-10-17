<div class="modal-details-comments">
    <h4>Comments</h4>
    @foreach ($taskitem->comments as $comment)
    <div class="comment-container">
        <div class="modal-user-comment">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
            <div class="user-comment">
                <h5>{{ $comment->user->name }}</h5>
                <p class="comment-result" onclick="toggleEdit(this)">{{ $comment->comment }}</p>
                <form action="/comment-edit/{{ $comment->id }}" method="POST" >
                    @csrf
                    @method('PUT')
                    <textarea name="comment">{{ $comment->comment }}</textarea>
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
    <div class="profile-comment">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="">
        <form action="/comment-create" method="POST">
            @csrf
            <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
            <textarea name="comment" placeholder="Comment here...."></textarea>
            <button type="submit">Send</button>
        </form>
    </div>
</div>
