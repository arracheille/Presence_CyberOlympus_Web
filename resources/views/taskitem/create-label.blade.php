<div class="dropdown">
    <button class="link">Label</button>
    <div class="dropdown-menu label-modal dropdown-color">
        <div class="dropdown-title-close">
            <h4>Insert Label</h4>
            <span class="close">&times;</span>
        </div>
        {{-- label dropdown --}}
        <form action="/label-create" method="POST" class="color-container">
            @csrf
            <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
            <input type="text" name="label" placeholder="Label Name...">
            <div class="grid-color">
                <input type="radio" id="option-task-item-modal-label-{{ $taskitem->id }}-1" name="label_background_color" value="gradient-orange" checked/>
                <label for="option-task-item-modal-label-{{ $taskitem->id }}-1" class="radio-button color" id="gradient-orange"></label>
                <input type="radio" id="option-task-item-modal-label-{{ $taskitem->id }}-2" name="label_background_color" value="gradient-red" />
                <label for="option-task-item-modal-label-{{ $taskitem->id }}-2" class="radio-button color" id="gradient-red"></label>
                <input type="radio" id="option-task-item-modal-label-{{ $taskitem->id }}-3" name="label_background_color" value="gradient-blue" />
                <label for="option-task-item-modal-label-{{ $taskitem->id }}-3" class="radio-button color" id="gradient-blue"></label>
                <input type="radio" id="option-task-item-modal-label-{{ $taskitem->id }}-4" name="label_background_color" value="gradient-green" />
                <label for="option-task-item-modal-label-{{ $taskitem->id }}-4" class="radio-button color" id="gradient-green"></label>
                <input type="radio" id="option-task-item-modal-label-{{ $taskitem->id }}-5" name="label_background_color" value="gradient-pink" />
                <label for="option-task-item-modal-label-{{ $taskitem->id }}-5" class="radio-button color" id="gradient-pink"></label>
                <input type="radio" id="option-task-item-modal-label-{{ $taskitem->id }}-6" name="label_background_color" value="gradient-purple" />
                <label for="option-task-item-modal-label-{{ $taskitem->id }}-6" class="radio-button color" id="gradient-purple"></label>
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
</div>