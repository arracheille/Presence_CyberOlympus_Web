<div class="dropdown">
    <button class="link">Attach</button>
    <div class="dropdown-menu background">
        <div class="dropdown-title-close">
            <h4>Attach Media</h4>
            <span class="close">&times;</span>
        </div>
        <form action="/attachment-create" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
            <label for="image">Upload A File (jpeg, jpg & png)</label>
            <input type="file" name="image" id="image">
            <hr>
            <label for="link">Or Upload A Link</label>
            <input type="text" name="link" id="link">
            <label for="link">Display Text</label>
            <input type="text" name="link_display" id="link_display">
            <button>Save</button>
        </form>
    </div>
</div>