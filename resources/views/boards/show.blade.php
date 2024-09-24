<x-app-layout>
    <h2>Task <span>{{ $board->title }}</span></h2>
    <div class="dashboard-wrapper">
        <ul class="dashboard-to-do">
            @foreach ($board->tasks as $task)
                <li class="to-do-card">
                    <h3>{{ $task->title }}</h3>
                    <form action="{{ route('task-items.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="task_id" value="{{ $task->id }}">
                        <div class="form-group">
                            <label for="title">Task Item Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Task Item</button>
                    </form>
                                            
                    <ul class="to-do-card-item">
                        @foreach ($task->taskItems as $taskItem)
                            <li><h5>{{ $taskItem->title }}</h5></li>
                            <li><p>{{ $taskItem->description }}</p></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
                <li class="to-do-card add-card">
                    <button class="to-do-card-item add-to-do-card-item" onclick="openAddTask()">
                        <i class="fa-solid fa-plus"></i>
                        <h5>Add New List</h5>
                    </button>    
                    <div id="addtaskModal" class="modal">
                        <div class="modal-content">
                            <div class="modal-title-close">
                                <h2>Add New Task</h2>
                                <span class="close" onclick="closeAddtask()">&times;</span>
                            </div>
                            <form action="{{ route('tasks.store', $board) }}" method="POST">
                                @csrf
                                <input type="hidden" name="board_id" value="{{ $board->id }}">
                                <div class="form-group">
                                    <label for="title">Task List Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="cancel-btn" onclick="cancelAddtask()">Cancel</button>
                                    <button type="submit" class="submit-btn">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
        </ul>        
    </div>

    <script>
        function openAddTask() {
        document.getElementById('addtaskModal').style.display = 'block';
        }
    
        function cancelAddtask() {
        document.getElementById('addtaskModal').style.display = 'none';
        }
    
        function closeAddtask() {
        document.getElementById('addtaskModal').style.display = 'none';
        }
    </script>
</x-app-layout>