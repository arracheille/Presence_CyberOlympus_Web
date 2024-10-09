<div id="addTaskitemModal" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
            <h2>Add New Task Item</h2>
            <span class="close" onclick="closeAddtaskitem()">&times;</span>
        </div>
            <form action="/task-item-create" method="POST">
                @csrf
                <input type="hidden" name="task_id" id="task_id" value="">
                <label for="title">Task Item Title</label>
                <input type="text" name="title">
                <label for="description">Description</label>
                <textarea name="description"></textarea>
                <div class="modal-footer">
                    <button type="submit" class="submit-btn">Submit</button>
                </div>
            </form>
    </div>
</div>