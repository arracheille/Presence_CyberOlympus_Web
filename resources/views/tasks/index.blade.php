<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="task">
        <h3>{{ $board->title }}</h3>
        <div class="wrapper" id="to-do-list-container">
            <div class="task-container" id="to-do-body">
                @foreach ($tasks as $task)
                @php
                    if ($task['background_color'] == 'gradient-orange') {
                    $task_color = "gradient-orange";
                    }elseif ($task['background_color'] == 'gradient-blue') {
                    $task_color = "gradient-blue";
                    }elseif ($task['background_color'] == 'gradient-green') {
                    $task_color = "gradient-green";
                    }elseif ($task['background_color'] == 'gradient-red') {
                    $task_color = "gradient-red";
                    }elseif ($task['background_color'] == 'gradient-pink') {
                    $task_color = "gradient-pink";
                    }elseif ($task['background_color'] == 'gradient-purple') {
                    $task_color = "gradient-purple";
                    }else{
                    $task_color = "white";
                    }
                @endphp
                <div class="content-task to-do-card-drag" id="{{ $task_color }}" data-id="{{ $task->id }}" draggable="true">
                    <div class="content-task-top to-do-card-content" onclick="openEdittask({{ $task->id }})">
                        <h4>{{ $task['title'] }}</h4>
                        <p>Created by: {{ $task->user->name }}</p>
                    </div>
    
                    <div id="editTaskModal-{{ $task->id }}" class="modal">
                        <div class="modal-content">
                            <div class="modal-title-close">
                                <h2>Edit Task <span>{{ $task->title }}</span></h2>
                                <span class="close" onclick="closeEdittask({{ $task->id }})">&times;</span>
                            </div>
                            <form action="/task-edit/{{ $task->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="editTaskid-{{ $task->id }}" name="id">
                                <label for="title">Title :</label>
                                <input type="text" name="title" value="{{ $task->title }}">
                                <div class="grid-color">
                                    <input type="radio" id="option-task-background-{{ $task->id }}-1" name="background_color" value="gradient-orange"
                                        @if($task->background_color == 'gradient-orange') checked @endif />
                                    <label for="option-task-background-{{ $task->id }}-1" class="radio-button color" id="gradient-orange"></label>
                                    
                                    <input type="radio" id="option-task-background-{{ $task->id }}-2" name="background_color" value="gradient-red"
                                        @if($task->background_color == 'gradient-red') checked @endif />
                                    <label for="option-task-background-{{ $task->id }}-2" class="radio-button color" id="gradient-red"></label>
                                    
                                    <input type="radio" id="option-task-background-{{ $task->id }}-3" name="background_color" value="gradient-blue"
                                        @if($task->background_color == 'gradient-blue') checked @endif />
                                    <label for="option-task-background-{{ $task->id }}-3" class="radio-button color" id="gradient-blue"></label>
                                    
                                    <input type="radio" id="option-task-background-{{ $task->id }}-4" name="background_color" value="gradient-green"
                                        @if($task->background_color == 'gradient-green') checked @endif />
                                    <label for="option-task-background-{{ $task->id }}-4" class="radio-button color" id="gradient-green"></label>
                                    
                                    <input type="radio" id="option-task-background-{{ $task->id }}-5" name="background_color" value="gradient-pink"
                                        @if($task->background_color == 'gradient-pink') checked @endif />
                                    <label for="option-task-background-{{ $task->id }}-5" class="radio-button color" id="gradient-pink"></label>
                                    
                                    <input type="radio" id="option-task-background-6" name="background_color" value="gradient-purple"
                                        @if($task->background_color == 'gradient-purple') checked @endif />
                                    <label for="option-task-background-6" class="radio-button color" id="gradient-purple"></label>
                                </div>
                                <button class="submit-btn">Submit</button>
                            </form>
                            <form action="/task-delete/{{ $task->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="task-item-container">
                        @foreach ($task->taskitems as $taskitem)
    
                        <div class="content-task-item to-do-card-content" id="to-do-card-item" data-id="{{ $taskitem->id }}" onclick="openEdittaskitem({{ $taskitem->id }})" draggable="true">
                            @php
                                $cover_color = "darkblue";
                            @endphp

                            @foreach ($taskitem->covers as $cover)
                                @php
                                    switch ($cover['background_color']) {
                                        case 'gradient-orange':
                                            $cover_color = "gradient-orange";
                                            break;
                                        case 'gradient-blue':
                                            $cover_color = "gradient-blue";
                                            break;
                                        case 'gradient-green':
                                            $cover_color = "gradient-green";
                                            break;
                                        case 'gradient-red':
                                            $cover_color = "gradient-red";
                                            break;
                                        case 'gradient-pink':
                                            $cover_color = "gradient-pink";
                                            break;
                                        case 'gradient-purple':
                                            $cover_color = "gradient-purple";
                                            break;
                                        default:
                                            $cover_color = "darkblue";
                                    }
                                @endphp
                            @endforeach
                            
                            <p id="{{ $cover_color }}">{{ $taskitem->title }}</p>

                            <div class="container-task-label">
                                @foreach ($taskitem->labels as $label)
                                @php
                                    if ($label['label_background_color'] == 'gradient-orange') {
                                    $label_item_color = "gradient-orange";
                                    }elseif ($label['label_background_color'] == 'gradient-blue') {
                                    $label_item_color = "gradient-blue";
                                    }elseif ($label['label_background_color'] == 'gradient-green') {
                                    $label_item_color = "gradient-green";
                                    }elseif ($label['label_background_color'] == 'gradient-red') {
                                    $label_item_color = "gradient-red";
                                    }elseif ($label['label_background_color'] == 'gradient-pink') {
                                    $label_item_color = "gradient-pink";
                                    }elseif ($label['label_background_color'] == 'gradient-purple') {
                                    $label_item_color = "gradient-purple";
                                    }else{
                                    $label_item_color = "darkblue";
                                    }
                                @endphp
                                <div class="content-task-label" id="{{ $label_item_color }}">
                                    <p>{{ $label['label'] }}</p>
                                  </div>
                                @endforeach
                            </div>
                            <p>{{ $taskitem->description }}</p>

                            <div class="container-task-component">
                                @if(!is_null($taskitem->description) && $taskitem->description !== '')
                                    <div class="content-task-component" id="item-description">
                                        <i class="fa-solid fa-align-left"></i>
                                    </div>
                                @endif

                                @if($taskitem->checks->whereNotNull('title')->where('title', '!=', '')->first())
                                    <div class="content-task-component" id="item-checklist">
                                        <i class="fa-solid fa-square-check"></i>
                                    </div>
                                @endif

                                @if($taskitem->comments->whereNotNull('comment')->where('comment', '!=', '')->first())
                                    <div class="content-task-component" id="item-comment">
                                        <i class="fa-solid fa-comments"></i>
                                    </div>
                                @endif
                                <div class="content-task-component" id="item-due-date">
                                  <i class="fa-solid fa-clock"></i>
                                </div>
                                <div class="content-task-component" id="item-attachment">
                                  <i class="fa-solid fa-paperclip"></i>
                                </div>
                              </div>       
                            </div>
    
                        <div id="editTaskItemModal-{{ $taskitem->id }}" class="modal">
                            <div class="modal-content">
                                <div class="modal-title-close" id="modal-background">
                                    <h2>Edit Task Item</h2>
                                    <span class="close" onclick="closeEdittaskitem({{ $taskitem->id }})">&times;</span>
                                </div>
                                <div class="modal-details">
                                    <div class="modal-details-content">
                                        <div class="modal-details-label" id="modal-label">
                                            <label for="hashtag-label">Label</label>
                                            <div class="hashtag-label-container">
                                                @foreach ($taskitem->labels as $label)
                                                @php
                                                    if ($label['label_background_color'] == 'gradient-orange') {
                                                    $label_modal_color = "gradient-orange";
                                                    }elseif ($label['label_background_color'] == 'gradient-blue') {
                                                    $label_modal_color = "gradient-blue";
                                                    }elseif ($label['label_background_color'] == 'gradient-green') {
                                                    $label_modal_color = "gradient-green";
                                                    }elseif ($label['label_background_color'] == 'gradient-red') {
                                                    $label_modal_color = "gradient-red";
                                                    }elseif ($label['label_background_color'] == 'gradient-pink') {
                                                    $label_modal_color = "gradient-pink";
                                                    }elseif ($label['label_background_color'] == 'gradient-purple') {
                                                    $label_modal_color = "gradient-purple";
                                                    }else{
                                                    $label_modal_color = "white";
                                                    }
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
                                        <div class="modal-details-due-date">
                                            <div class="due-date-container">
                                                <form action="">
                                                    <label for="date">Due Date</label>
                                                    <input type="datetime-local" name="end" id="date-end date">
                                                </form>
                                            </div>
                                        </div>
                                        @if ($taskitem->checks->isEmpty())
                                            
                                        @else
                                            <h5>Checklists</h5>
                                            @foreach ($taskitem->checks as $check)
                                            <div class="modal-details-checklist">
                                                <div class="dropdown checklist-edit">
                                                    <h4 class="link">{{ $check->title }}</h4>
                                                    <div class="dropdown-menu checklist">
                                                        <div class="dropdown-title-close">
                                                          <h4>Edit Checklist</h4>
                                                          <span class="close">&times;</span>
                                                        </div>
                                                        {{-- label modal --}}
                                                        <form action="/check-edit/{{ $check->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                                                            <input type="text" name="title" value="{{ $check->title }}" required>
                                                            <button type="submit">Save</button>
                                                        </form>
                                                        <form action="/check-delete/{{ $check->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="delete-btn">Delete</button>
                                                        </form>
                                                      </div>
                                                </div>
                                                  @if($check->checklists->isNotEmpty())
                                                    @php
                                                        $totalChecklists = $check->checklists->count();
                                                        $checkedCount = $check->checklists->where('is_checked', true)->count();
                                                    @endphp
                                                    <div class="checklist-progress-container">
                                                        {{-- <div class="checklist-progress-content">
                                                            <div class="checklist-progress-bar" style="width: 0%;"></div>
                                                        </div> --}}
                                                        <p>{{ $checkedCount }} of {{ $totalChecklists }} Checked</p>
                                                    </div>
                                                @endif
                                                <div class="checklist-items-container">
                                                    @foreach ($check->checklists as $checklist)
                                                    <div class="checklist-items-content">
                                                        <form action="/checklist-edit/{{ $checklist->id }}" class="checklist-items-content">
                                                            <label class="checkbox-item-input" for="checklist{{ $checklist->id }}">
                                                              {{ $checklist->checklist_title }}
                                                              <input type="checkbox" id="checklist{{ $checklist->id }}" onchange="checklist({{ $checklist->id }}, '{{ $checklist->checklist_title }}')" name="is_checked" value="{{ $checklist->is_checked }}" {{ $checklist->is_checked == 1 ? 'checked' : '' }}/>
                                                              <span class="check"></span>
                                                            </label>
                                                          </form>
                                                          <form action="/checklist-delete/{{ $checklist->id }}" method="POST">
                                                              @csrf
                                                              @method('DELETE')
                                                              <button class="icon">&times;</button>   
                                                          </form>
                                                    </div>
                                                    @endforeach  
                                                </div>
                                                <div class="dropdown">
                                                    <button class="link">+</button>
                                                    <div class="dropdown-menu checklist">
                                                      <div class="dropdown-title-close">
                                                        <h4>Insert Checklist</h4>
                                                        <span class="close">&times;</span>
                                                      </div>
                                                      <form action="/checklist-create" method="POST">
                                                          @csrf
                                                          <input type="hidden" name="check_id" value="{{ $check->id }}">
                                                          <input type="text" name="checklist_title">
                                                          <button type="submit">Save</button>
                                                      </form>
                                                    </div>
                                                  </div>
                                            </div>
                                            @endforeach    
                                        @endif
                                        <form action="/task-item-edit/{{ $taskitem->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="editTaskitemid-{{ $taskitem->id }}" name="id">
                                            <label for="title">Title :</label>
                                            <input type="text" name="title" value="{{ $taskitem->title }}">
                                            <label for="description">Description</label>
                                            <textarea name="description">{{ $taskitem->description }}</textarea>
                                            <button class="submit-btn">Submit</button>
                                        </form>
                                        <div class="modal-details-comments">
                                            <h4>Comments</h4>
                                            @foreach ($taskitem->comments as $comment)
                                            <div class="comment-container">
                                                <h5>{{ $comment->title }}</h5>
                                                <div class="modal-user-comment">
                                                    <h5>{{ $comment->user->name }}</h5>
                                                    <p class="comment-result">{{ $comment->comment }}</p>
                                                </div>
                                            </div>
                                            @endforeach
                                            <form action="/comment-create" method="POST">
                                                @csrf
                                                <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                                                <textarea name="comment" placeholder="Comment here...."></textarea>
                                                <button type="submit">Send</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-detail-buttons">
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
                                        <div class="dropdown">
                                            <button class="link">Background</button>
                                            <div class="dropdown-menu background dropdown-color">
                                                <div class="dropdown-title-close">
                                                    <h4>Choose Background</h4>
                                                    <span class="close">&times;</span>
                                                </div>
                                                <form action="/cover-create" method="POST" class="color-container">
                                                    @csrf
                                                    <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                                                    <label for="background_image_id">Or Upload A File</label>
                                                    <input type="file" name="background_image" id="background_image_id">
                                                    <div class="grid-color">
                                                        <input type="radio" id="option-task-item-background-{{ $taskitem->id }}-1" name="background_color" value="gradient-orange" checked/>
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
                                                    <button type="submit">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="dropdown">
                                            <button class="link">Due Date</button>
                                            <div class="dropdown-menu background">
                                                <div class="dropdown-title-close">
                                                    <h4>Set Task Due Date</h4>
                                                    <span class="close">&times;</span>
                                                </div>
                                                <form action="/schedule-component-create" method="POST" class="due-date-modal">
                                                    @csrf
                                                    <input type="text" id="title" name="title" value="{{ $taskitem->title }}" style="display: none">
                                                    <input type="hidden" value="gradient-blue" name="background_color">
                                                    <input type="datetime-local" id="start-date" name="start" style="display: none">
                                                    <label for="due_date">Due Date</label>
                                                    <input type="datetime-local" id="end-date" name="end">
                                                    <button>Save</button>
                                                </form>
                                            </div>
                                        </div>
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
                                        <button>Attach</button>
                                        <form id="delete-form-{{ $taskitem->id }}" action="/task-item-delete/{{ $taskitem->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="delete-btn" onclick="confirmDelete('delete-form-{{ $taskitem->id }}')">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                        @endforeach    
                    </div>
                    <button class="add-item" onclick="openAddtaskitem({{ $task->id }})">
                        <i class="fa-solid fa-plus"></i>
                        <p class="p-bold">Add Another Item</p>
                    </button>     
                </div>
                @endforeach
                <div class="content-task add-task" onclick="openAddtask({{ Request::segment(2) }})">
                    <p><i class="fa-solid fa-plus"></i> Add New task</p>
                  </div>    
            </div>
        </div>    
    </div>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.3/Sortable.min.js" integrity="sha512-8AwTn2Tax8NWI+SqsYAXiKT8jO11WUBzTEWRoilYgr5GWnF4fNqBRD+hCr4JRSA1eZ/qwbI+FPsM3X/PQeHgpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('components.sortabletaskitem')
    @include('components.sortabletask')
    @include('components.dropdownform')
    @include('components.jquery')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.getElementById('start-date');
            const endDateInput = document.getElementById('end-date');

            function formatDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                const hours = String(date.getHours()).padStart(2, '0');
                const minutes = String(date.getMinutes()).padStart(2, '0');
                return `${year}-${month}-${day}T${hours}:${minutes}`;
            }

            const now = new Date();

            const tomorrow = new Date(now);
            tomorrow.setDate(now.getDate() + 1);

            startDateInput.value = formatDate(now);

            endDateInput.value = formatDate(tomorrow);
        });

        function openAddtask(board_id) {
            document.getElementById('addtaskModal').style.display = 'block';
            document.getElementById('board_id').value = board_id;
        }
    
        function closeAddtask() {
        document.getElementById('addtaskModal').style.display = 'none';
        }

        function openAddtaskitem(task_id) {
            document.getElementById('addTaskitemModal').style.display = 'block';
            document.getElementById('task_id').value = task_id;
        }
    
        function closeAddtaskitem() {
        document.getElementById('addTaskitemModal').style.display = 'none';
        }

        function openEdittask(id) {
            document.getElementById('editTaskModal-' + id).style.display = 'block';
            document.getElementById('editTaskid-' + id).value = id;
        }

        function closeEdittask(id) {
            document.getElementById('editTaskModal-' + id).style.display = 'none';
        }

        function openEdittaskitem(id) {
            document.getElementById('editTaskItemModal-' + id).style.display = 'block';
            document.getElementById('editTaskitemid-' + id).value = id;
        }

        function closeEdittaskitem(id) {
            document.getElementById('editTaskItemModal-' + id).style.display = 'none';
        }

        function confirmDelete(formId) {
            const form = document.getElementById(formId);

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function checklist(id, checklistTitle) {
            let is_checked = $('#checklist'+id).is(":checked") == true ? 1 : 0;
            let title = encodeURIComponent(checklistTitle);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "PUT",
                cache: false,
                url: "{{ route('checklist.update') }}",
                data: {
                    'check_id' : id,
                    is_checked,
                },
                success: function (res) {
                    if (res.message == 'Berhasil simpan') {
                        if (res.is_checked == 1) {
                            $('#checklist'+id).prop('checked', true);
                        } else {
                            $('#checklist'+id).prop('checked', false);
                        }
                        $('.checklist-progress-container p').text(res.checkedCount + ' of ' + res.totalChecklists + ' Checked');
                    } else {
                        console.log('Error');
                    }
                }
            })
        }

        // function checklist(id, checklistTitle) {
        //     let is_checked = $('#checklist'+id).is(":checked") == true ? 1 : 0;
        //     let title      = encodeURIComponent(checklistTitle);

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         type: "PUT",
        //         cache: 'false',
        //         url: "{{ route('checklist.update') }}",
        //         data:{
        //             'check_id' : id,
        //             is_checked,
        //         },
        //         success: function (res) {
        //             if (res.message == 'Berhasil simpan') {
        //                 if (res.is_checked == 1) {
        //                     $('#checklist'+id).prop('checked', true);
        //                 } else {
        //                     $('#checklist'+id).prop('checked', false);
        //                 }
        //             } else {
        //             }
        //         }
        //     })
        // }
    </script>    
</x-app-layout>