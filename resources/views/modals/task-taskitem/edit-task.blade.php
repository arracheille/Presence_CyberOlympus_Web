<div id="editTaskModal-{{ $task->id }}" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
            <div class="title-fav">
                <h2>Edit Task <span>{{ $task->title }}</span></h2>
                <form action="{{ route('task.favorite', $task->id) }}" method="POST" class="star-form">
                    @csrf
                    <input type="checkbox" id="checkbox-task-fav-{{ $task->id }}" data-task-id="{{ $task->id }}" onclick="toggleFavoriteTask(this)" {{ auth()->user()->favorite_tasks()->where('task_id', $task->id)->exists() ? 'checked' : '' }}>
                    {{-- <input type="checkbox" id="checkbox-task-fav" onclick="toggleFavoriteTask(this)" {{ auth()->user()->favorite_tasks()->where('task_id', $task->id)->exists() ? 'checked' : '' }}> --}}
                    <label for="checkbox-task-fav-{{ $task->id }}">
                        <div class="starred"><i class="fa-solid fa-star"></i></div>
                        <div class="unstar"><i class="fa-regular fa-star"></i></div>
                    </label>
                </form>
            </div>
            <span class="close" onclick="closeEdittask({{ $task->id }})">&times;</span>
        </div>
        <form action="/task-edit/{{ $task->id }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="editTaskid-{{ $task->id }}" name="id">
            <label for="title">Title :</label>
            <input type="text" name="title" value="{{ $task->title }}">
            <div class="grid-color">
                <input type="radio" id="option-edit-task-background-{{ $task->id }}-1" name="background_color" value="gradient-orange"
                    @if($task->background_color == 'gradient-orange') checked @endif />
                <label for="option-edit-task-background-{{ $task->id }}-1" class="radio-button color" id="gradient-orange"></label>
                
                <input type="radio" id="option-edit-task-background-{{ $task->id }}-2" name="background_color" value="gradient-red"
                    @if($task->background_color == 'gradient-red') checked @endif />
                <label for="option-edit-task-background-{{ $task->id }}-2" class="radio-button color" id="gradient-red"></label>
                
                <input type="radio" id="option-edit-task-background-{{ $task->id }}-3" name="background_color" value="gradient-blue"
                    @if($task->background_color == 'gradient-blue') checked @endif />
                <label for="option-edit-task-background-{{ $task->id }}-3" class="radio-button color" id="gradient-blue"></label>
                
                <input type="radio" id="option-edit-task-background-{{ $task->id }}-4" name="background_color" value="gradient-green"
                    @if($task->background_color == 'gradient-green') checked @endif />
                <label for="option-edit-task-background-{{ $task->id }}-4" class="radio-button color" id="gradient-green"></label>
                
                <input type="radio" id="option-edit-task-background-{{ $task->id }}-5" name="background_color" value="gradient-pink"
                    @if($task->background_color == 'gradient-pink') checked @endif />
                <label for="option-edit-task-background-{{ $task->id }}-5" class="radio-button color" id="gradient-pink"></label>
                
                <input type="radio" id="option-edit-task-background-{{ $task->id }}-6" name="background_color" value="gradient-purple"
                    @if($task->background_color == 'gradient-purple') checked @endif />
                <label for="option-edit-task-background-{{ $task->id }}-6" class="radio-button color" id="gradient-purple"></label>
            </div>
            <button class="submit-btn">Submit</button>
        </form>
        <form action="/task-delete/{{ $task->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">Archive</button>
        </form>
    </div>
</div>