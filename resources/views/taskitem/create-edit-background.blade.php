<div class="dropdown">
    <button class="link">Background</button>
    <div class="dropdown-menu background dropdown-color">
        <div class="dropdown-title-close">
            <h4>Choose Background</h4>
            <span class="close">&times;</span>
        </div>
        @if ($taskitem->covers->where('task_item_id', $taskitem->id)->isEmpty())
            <form action="/cover-create" method="POST" enctype="multipart/form-data" class="color-container">
                @csrf
                <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                <div class="grid-color">
                    <input type="radio" id="option-task-item-background-{{ $taskitem->id }}-1" name="background_color" value="gradient-orange"/>
                    <label for="option-task-item-background-{{ $taskitem->id }}-1" class="radio-button color" id="gradient-orange"></label>
                    <input type="radio" id="option-task-item-background-{{ $taskitem->id }}-2" name="background_color" value="gradient-red" />
                    <label for="option-task-item-background-{{ $taskitem->id }}-2" class="radio-button color" id="gradient-red"></label>
                    <input type="radio" id="option-task-item-background-{{ $taskitem->id }}-3" name="background_color" value="gradient-blue" />
                    <label for="option-task-item-background-{{ $taskitem->id }}-3" class="radio-button color" id="gradient-blue"></label>
                    <input type="radio" id="option-task-item-background-{{ $taskitem->id }}-4" name="background_color" value="gradient-green" />
                    <label for="option-task-item-background-{{ $taskitem->id }}-4" class="radio-button color" id="gradient-green"></label>
                    <input type="radio" id="option-task-item-background-{{ $taskitem->id }}-5" name="background_color" value="gradient-pink" />
                    <label for="option-task-item-background-{{ $taskitem->id }}-5" class="radio-button color" id="gradient-pink"></label>
                    <input type="radio" id="option-task-item-background-{{ $taskitem->id }}-6" name="background_color" value="gradient-purple" />
                    <label for="option-task-item-background-{{ $taskitem->id }}-6" class="radio-button color" id="gradient-purple"></label>
                </div>
                <label for="background_image">Or Upload A File</label>
                <input type="file" name="background_image" id="background_image">
                <button type="submit">Save</button>
            </form>
        @else
            @foreach ($taskitem->covers as $cover)
            <form action="/cover-edit/{{ $cover->id }}" method="POST" enctype="multipart/form-data" class="color-container">
                @csrf
                @method('PUT')
                <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                <div class="grid-color">
                    <input type="radio" id="option-task-item-cover-{{ $cover->id }}-1" name="background_color" value="gradient-orange"
                        @if($cover->background_color == 'gradient-orange') checked @endif />
                    <label for="option-task-item-cover-{{ $cover->id }}-1" class="radio-button color" id="gradient-orange"></label>
                    
                    <input type="radio" id="option-task-item-cover-{{ $cover->id }}-2" name="background_color" value="gradient-red"
                        @if($cover->background_color == 'gradient-red') checked @endif />
                    <label for="option-task-item-cover-{{ $cover->id }}-2" class="radio-button color" id="gradient-red"></label>
                    
                    <input type="radio" id="option-task-item-cover-{{ $cover->id }}-3" name="background_color" value="gradient-blue"
                        @if($cover->background_color == 'gradient-blue') checked @endif />
                    <label for="option-task-item-cover-{{ $cover->id }}-3" class="radio-button color" id="gradient-blue"></label>
                    
                    <input type="radio" id="option-task-item-cover-{{ $cover->id }}-4" name="background_color" value="gradient-green"
                        @if($cover->background_color == 'gradient-green') checked @endif />
                    <label for="option-task-item-cover-{{ $cover->id }}-4" class="radio-button color" id="gradient-green"></label>
                    
                    <input type="radio" id="option-task-item-cover-{{ $cover->id }}-5" name="background_color" value="gradient-pink"
                        @if($cover->background_color == 'gradient-pink') checked @endif />
                    <label for="option-task-item-cover-{{ $cover->id }}-5" class="radio-button color" id="gradient-pink"></label>
                    
                    <input type="radio" id="option-task-item-cover-{{ $cover->id }}-6" name="background_color" value="gradient-purple"
                        @if($cover->background_color == 'gradient-purple') checked @endif />
                    <label for="option-task-item-cover-{{ $cover->id }}-6" class="radio-button color" id="gradient-purple"></label>
                </div>
                <hr>
                <label for="background_image">Or Upload A File</label>
                @if (empty($cover->background_image))
                @else
                <p class="text-small">Current Image: {{ basename($cover->background_image) }}</p>
                @endif
                <input type="file" name="background_image" id="background_image" value="{{ $cover->background_image }}">
                <button type="submit">Save</button>
            </form>    
            @endforeach
        @endif
    </div>
</div>