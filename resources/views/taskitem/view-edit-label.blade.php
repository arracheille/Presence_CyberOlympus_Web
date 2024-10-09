<div class="modal-details-label" id="modal-label">
    <label for="hashtag-label">Label</label>
    <div class="hashtag-label-container">
        @foreach ($taskitem->labels as $label)
        @php
        $label_modal_color = match ($label['label_background_color']) {
            'gradient-orange' => 'gradient-orange',
            'gradient-blue' => 'gradient-blue',
            'gradient-green' => 'gradient-green',
            'gradient-red' => 'gradient-red',
            'gradient-pink' => 'gradient-pink',
            'gradient-purple' => 'gradient-purple',
            default => 'darkblue',
        };
        @endphp
        <div class="dropdown label-edit">
            <button class="link">
                <div class="content-task-label" id="{{ $label_modal_color }}">
                    <p>{{ $label['label'] }}</p>
                </div>
            </button>
            <div class="dropdown-menu label dropdown-color">
                <div class="dropdown-title-close">
                  <h4>Edit Label</h4>
                  <span class="close">&times;</span>
                </div>
                {{-- label modal --}}
                <form action="/label-edit/{{ $label->id }}" method="POST" class="color-container">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                    <input type="text" name="label" value="{{ $label->label }}">
                    <div class="grid-color">
                        <input type="radio" id="option-task-item-label-{{ $label->id }}-1" name="label_background_color" value="gradient-orange"
                            @if($label->label_background_color == 'gradient-orange') checked @endif />
                        <label for="option-task-item-label-{{ $label->id }}-1" class="radio-button color" id="gradient-orange"></label>
                        
                        <input type="radio" id="option-task-item-label-{{ $label->id }}-2" name="label_background_color" value="gradient-red"
                            @if($label->label_background_color == 'gradient-red') checked @endif />
                        <label for="option-task-item-label-{{ $label->id }}-2" class="radio-button color" id="gradient-red"></label>
                        
                        <input type="radio" id="option-task-item-label-{{ $label->id }}-3" name="label_background_color" value="gradient-blue"
                            @if($label->label_background_color == 'gradient-blue') checked @endif />
                        <label for="option-task-item-label-{{ $label->id }}-3" class="radio-button color" id="gradient-blue"></label>
                        
                        <input type="radio" id="option-task-item-label-{{ $label->id }}-4" name="label_background_color" value="gradient-green"
                            @if($label->label_background_color == 'gradient-green') checked @endif />
                        <label for="option-task-item-label-{{ $label->id }}-4" class="radio-button color" id="gradient-green"></label>
                        
                        <input type="radio" id="option-task-item-label-{{ $label->id }}-5" name="label_background_color" value="gradient-pink"
                            @if($label->label_background_color == 'gradient-pink') checked @endif />
                        <label for="option-task-item-label-{{ $label->id }}-5" class="radio-button color" id="gradient-pink"></label>
                        
                        <input type="radio" id="option-task-item-label-{{ $label->id }}-6" name="label_background_color" value="gradient-purple"
                            @if($label->label_background_color == 'gradient-purple') checked @endif />
                        <label for="option-task-item-label-{{ $label->id }}-6" class="radio-button color" id="gradient-purple"></label>
                    </div>
                    <button type="submit">Save</button>
                </form>
                <form action="/label-delete/{{ $label->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
              </div>
        </div>
        @endforeach
        <div class="dropdown">
          <button class="link">+</button>
          <div class="dropdown-menu label dropdown-color">
            <div class="dropdown-title-close">
              <h4>Insert Label</h4>
              <span class="close">&times;</span>
            </div>
            {{-- label modal --}}
            <form action="/label-create" method="POST" class="color-container">
                @csrf
                <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                <input type="text" name="label" placeholder="Label Name...">
                <div class="grid-color">
                    <input type="radio" id="option-task-item-label-{{ $taskitem->id }}-1" name="label_background_color" value="gradient-orange" checked/>
                    <label for="option-task-item-label-{{ $taskitem->id }}-1" class="radio-button color" id="gradient-orange"></label>
                    <input type="radio" id="option-task-item-label-{{ $taskitem->id }}-2" name="label_background_color" value="gradient-red" />
                    <label for="option-task-item-label-{{ $taskitem->id }}-2" class="radio-button color" id="gradient-red"></label>
                    <input type="radio" id="option-task-item-label-{{ $taskitem->id }}-3" name="label_background_color" value="gradient-blue" />
                    <label for="option-task-item-label-{{ $taskitem->id }}-3" class="radio-button color" id="gradient-blue"></label>
                    <input type="radio" id="option-task-item-label-{{ $taskitem->id }}-4" name="label_background_color" value="gradient-green" />
                    <label for="option-task-item-label-{{ $taskitem->id }}-4" class="radio-button color" id="gradient-green"></label>
                    <input type="radio" id="option-task-item-label-{{ $taskitem->id }}-5" name="label_background_color" value="gradient-pink" />
                    <label for="option-task-item-label-{{ $taskitem->id }}-5" class="radio-button color" id="gradient-pink"></label>
                    <input type="radio" id="option-task-item-label-{{ $taskitem->id }}-6" name="label_background_color" value="gradient-purple" />
                    <label for="option-task-item-label-{{ $taskitem->id }}-6" class="radio-button color" id="gradient-purple"></label>                                    
                </div>
                <button type="submit">Save</button>
            </form>
          </div>
        </div>
    </div>
</div>