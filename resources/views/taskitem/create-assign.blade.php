<div class="dropdown">
    <button class="link">Assign</button>
    <div class="dropdown-menu label-modal dropdown-color">
        <div class="dropdown-title-close">
            <h4>Assign This Task Item To</h4>
            <span class="close">&times;</span>
        </div>
        <form action="/assign-create" method="POST" class="color-container">
            @csrf
            <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
            <input type="hidden" name="task_id" value="">
            <select name="user">
                @foreach ($workspaces as $workspace)
                    @foreach($workspace->members as $member)
                        <option value="{{ $member->user->name }}"> {{ $member->user->name }} </option>
                    @endforeach
                @endforeach
            </select>
            <button type="submit">Save</button>
        </form>
    </div>
</div>