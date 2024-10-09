<div class="dropdown">
    <button class="link">Checklist</button>
    <div class="dropdown-menu background">
        <div class="dropdown-title-close">
            <h4>Checklist Title</h4>
            <span class="close">&times;</span>
        </div>
        <form action="/check-create" method="POST">
            @csrf
            <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
            <input type="text" name="title" placeholder="Checklist title..." required>
            <button>Save</button>
        </form>
    </div>
</div>