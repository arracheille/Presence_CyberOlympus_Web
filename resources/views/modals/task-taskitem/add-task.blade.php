<div id="addtaskModal" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
            <h2>Add Task</h2>
            <span class="close" onclick="closeAddtask()">&times;</span>
        </div>
        <form action="/task-create" method="POST">
            @csrf
            <input type="hidden" name="board_id" id="board_id" value="">
            <label for="title">Task Title</label>
            <input type="text" name="title">
            <h4>Choose Background Color</h4>
            <div class="grid-color">
                <input type="radio" id="option-task-background-1" name="background_color" value="gradient-orange" checked/>
                <label for="option-task-background-1" class="radio-button color" id="gradient-orange"></label>
                <input type="radio" id="option-task-background-2" name="background_color" value="gradient-red" />
                <label for="option-task-background-2" class="radio-button color" id="gradient-red"></label>
                <input type="radio" id="option-task-background-3" name="background_color" value="gradient-blue" />
                <label for="option-task-background-3" class="radio-button color" id="gradient-blue"></label>
                <input type="radio" id="option-task-background-4" name="background_color" value="gradient-green" />
                <label for="option-task-background-4" class="radio-button color" id="gradient-green"></label>
                <input type="radio" id="option-task-background-5" name="background_color" value="gradient-pink" />
                <label for="option-task-background-5" class="radio-button color" id="gradient-pink"></label>
                <input type="radio" id="option-task-background-6" name="background_color" value="gradient-purple" />
                <label for="option-task-background-6" class="radio-button color" id="gradient-purple"></label>
            </div>
            <div class="modal-footer">
                <button class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div>