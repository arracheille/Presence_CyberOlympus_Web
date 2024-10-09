<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="task">
        <div class="task-info">
            <div class="task-desc">
                <h2>{{ $board->title }}</h2>
                <p>From workspace <strong>{{ $board->workspace->title }}</strong></p>
            </div>
            <div class="task-share">
                <div class="dropdown">
                    <button class="link gradient-h-blue">Filter</button>
                    <div class="dropdown-menu label-modal dropdown-color"">
                        <div class="dropdown-title-close">
                            <h4>Filter Task & Task Item</h4>
                            <span class="close">&times;</span>
                        </div>
                        <div class="filter-item bytext  color-container">
                            <h5>Filter by text</h5>
                            <input type="text" name="search" placeholder="Search...">
                        </div>
                        <div class="filter-item bylabel color-container">
                            <h5>Filter by label</h5>
                            <input type="text" name="label" placeholder="Label Name...">
                            <div class="grid-color">
                                <input type="radio" id="option-filter-by-label-1" name="label_background_color" value="gradient-orange" checked/>
                                <label for="option-filter-by-label-1" class="radio-button color" id="gradient-orange"></label>
                                <input type="radio" id="option-filter-by-label-2" name="label_background_color" value="gradient-red" />
                                <label for="option-filter-by-label-2" class="radio-button color" id="gradient-red"></label>
                                <input type="radio" id="option-filter-by-label-3" name="label_background_color" value="gradient-blue" />
                                <label for="option-filter-by-label-3" class="radio-button color" id="gradient-blue"></label>
                                <input type="radio" id="option-filter-by-label-4" name="label_background_color" value="gradient-green" />
                                <label for="option-filter-by-label-4" class="radio-button color" id="gradient-green"></label>
                                <input type="radio" id="option-filter-by-label-5" name="label_background_color" value="gradient-pink" />
                                <label for="option-filter-by-label-5" class="radio-button color" id="gradient-pink"></label>
                                <input type="radio" id="option-filter-by-label-6" name="label_background_color" value="gradient-purple" />
                                <label for="option-filter-by-label-6" class="radio-button color" id="gradient-purple"></label>                                    
                            </div>
                        </div>
                        <div class="filter-item bycolor color-container">
                            <h5>Filter by background color</h5>
                            <div class="grid-color">
                                <input type="radio" id="option-task-item-background-1" name="background_color" value="gradient-orange" checked/>
                                <label for="option-task-item-background-1" class="radio-button color" id="gradient-orange"></label>
                                <input type="radio" id="option-task-item-background-2" name="background_color" value="gradient-red" />
                                <label for="option-task-item-background-2" class="radio-button color" id="gradient-red"></label>
                                <input type="radio" id="option-task-item-background-3" name="background_color" value="gradient-blue" />
                                <label for="option-task-item-background-3" class="radio-button color" id="gradient-blue"></label>
                                <input type="radio" id="option-task-item-background-4" name="background_color" value="gradient-green" />
                                <label for="option-task-item-background-4" class="radio-button color" id="gradient-green"></label>
                                <input type="radio" id="option-task-item-background-5" name="background_color" value="gradient-pink" />
                                <label for="option-task-item-background-5" class="radio-button color" id="gradient-pink"></label>
                                <input type="radio" id="option-task-item-background-6" name="background_color" value="gradient-purple" />
                                <label for="option-task-item-background-6" class="radio-button color" id="gradient-purple"></label>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown board-visibility">
                    <button class="link gradient-h-blue">Visibility</button>
                    <div class="dropdown-menu ">
                        <div class="dropdown-title-close">
                            <h4>Board Visibility</h4>
                            <span class="close">&times;</span>
                        </div>
                        <form action="{{ url('/edit-visibility/' . Request::segment(4))}}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="visibility" id="visibility">
                                <option value="allmembers" {{ $board->visibility == 'allmembers' ? 'selected' : '' }}>Visible to all members</option>
                                <option value="private" {{ $board->visibility == 'private' ? 'selected' : '' }}>Private</option>
                            </select>
                            <button>Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper" id="to-do-list-container">
            <div class="task-container" id="to-do-body">
                @foreach ($board->tasks as $task)
                @php
                $task_color = match ($task['background_color']) {
                    'gradient-orange' => 'gradient-orange',
                    'gradient-blue' => 'gradient-blue',
                    'gradient-green' => 'gradient-green',
                    'gradient-red' => 'gradient-red',
                    'gradient-pink' => 'gradient-pink',
                    'gradient-purple' => 'gradient-purple',
                    default => 'darkblue',
                };
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

                            @if ($taskitem->covers->isEmpty())
                            @else
                                @foreach ($taskitem->covers as $cover)
                                    @php
                                    $cover_color = match ($cover['background_color']) {
                                        'gradient-orange' => 'gradient-orange',
                                        'gradient-blue' => 'gradient-blue',
                                        'gradient-green' => 'gradient-green',
                                        'gradient-red' => 'gradient-red',
                                        'gradient-pink' => 'gradient-pink',
                                        'gradient-purple' => 'gradient-purple',
                                        default => 'darkblue',
                                    };
                                    @endphp

                                    @if (empty($cover->background_image))
                                    @else
                                        <div class="taskitem-background">
                                            <img src="{{ asset($cover->background_image) }}">
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                            <p id="{{ $cover_color }}">{{ $taskitem->title }}</p>
                        
                            @if ($taskitem->labels->isEmpty())
                            @else
                                <div class="container-task-label">
                                    @foreach ($taskitem->labels as $label)
                                    @php
                                    $label_item_color = match ($label['label_background_color']) {
                                        'gradient-orange' => 'gradient-orange',
                                        'gradient-blue' => 'gradient-blue',
                                        'gradient-green' => 'gradient-green',
                                        'gradient-red' => 'gradient-red',
                                        'gradient-pink' => 'gradient-pink',
                                        'gradient-purple' => 'gradient-purple',
                                        default => 'darkblue',
                                    };
                                    @endphp
                                    <div class="content-task-label" id="{{ $label_item_color }}">
                                        <p>{{ $label['label'] }}</p>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                            
                            @if(!is_null($taskitem->description) && $taskitem->description !== '')
                                <p>{{ $taskitem->description }}</p>
                            @endif
                            
                            @if(!is_null($taskitem->description) && $taskitem->description !== '' ||
                                $taskitem->checks->whereNotNull('title')->where('title', '!=', '')->first() ||
                                $taskitem->comments->whereNotNull('comment')->where('comment', '!=', '')->first() ||
                                $taskitem->schedules->whereNotNull('task_item_id')->where('task_item_id', '!=', '')->first() ||
                                $taskitem->assigns->whereNotNull('task_item_id')->where('task_item_id', '!=', '')->first() ||
                                $taskitem->attachments->whereNotNull('link')->where('link', '!=', '')->first() ||
                                $taskitem->attachments->whereNotNull('link_display')->where('link_display', '!=', '')->first() ||
                                $taskitem->attachments->whereNotNull('image')->where('image', '!=', '')->first())
                                <div class="container-task-component">
                                    
                                    @if($taskitem->assigns->whereNotNull('task_item_id')->where('task_item_id', '!=', '')->first())
                                        <div class="content-task-component" id="item-checklist">
                                            <i class="fa-solid fa-user-tag"></i>
                                        </div>
                                    @endif

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

                                    @if($taskitem->schedules->whereNotNull('task_item_id')->where('task_item_id', '!=', '')->first())
                                        <div class="content-task-component" id="item-due-date">
                                            <i class="fa-solid fa-clock"></i>
                                        </div>
                                    @endif

                                    @if($taskitem->attachments->whereNotNull('image')->where('image', '!=', '')->first() || 
                                        $taskitem->attachments->whereNotNull('link')->where('link', '!=', '')->first() ||
                                        $taskitem->attachments->whereNotNull('link_display')->where('link_display', '!=', '')->first())
                                        <div class="content-task-component" id="item-attachment">
                                            <i class="fa-solid fa-paperclip"></i>
                                        </div>
                                    @endif

                                </div>
                            @endif
                        </div>
                        <div id="editTaskItemModal-{{ $taskitem->id }}" class="modal">
                            <div class="modal-content">
                                <div class="modal-title-close" id="modal-background">
                                    <h2>Edit Task Item</h2>
                                    <span class="close" onclick="closeEdittaskitem({{ $taskitem->id }})">&times;</span>
                                </div>
                                <p>From Task <strong>{{ $taskitem->tasks->title }}</strong></p>
                                <div class="modal-details">
                                    <div class="modal-details-content">
                                        @if ($taskitem->assigns->isEmpty())
                                            
                                        @else
                                            <div class="modal-details-assign">
                                            <p>
                                                This Task Item is Assigned to 
                                                <span>{{ $taskitem->assigns->pluck('user')->implode(', ') }}</span>
                                            </p>
                                        </div>
                                        @endif
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
                                        @if ($taskitem->schedules->isEmpty())
                                        @else
                                        <label for="">Due Date</label>
                                        @foreach ($taskitem->schedules as $schedule)
                                        <div class="modal-details-due-date">
                                            <div class="due-date-container">
                                                <form action="/schedule-edit/{{ $schedule->id }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="text" id="title" name="title" value="{{ $taskitem->title }}" style="display: none">
                                                    <input type="hidden" value="gradient-blue" name="background_color">
                                                    <input type="datetime-local" id="start-date" name="start" style="display: none">
                                                    <input type="datetime-local" name="end" value="{{ $schedule->end }}">
                                                </form>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
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
                                                        <form action="/check-edit/{{ $check->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                                                            <input type="text" name="title" value="{{ $check->title }}">
                                                            <button>Save</button>
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
                                                        $totalChecklists = $check->checklists->where('check_id' == $check->id)->count();
                                                        $checkedCount = $check->checklists->where('is_checked', true)->count();
                                                    @endphp
                                                    <div class="checklist-progress-container">
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
                                        @if ($taskitem->attachments->isEmpty())
                                            
                                        @else
                                        <h4>Attachments</h4>
                                            @foreach ($taskitem->attachments as $attachment)
                                            @if (empty($attachment->image))
                                            
                                            @else
                                            <div class="attachment-edit-container">
                                                <div class="dropdown">
                                                    <button class="link"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                                    <div class="dropdown-menu dropdown-color">
                                                      <div class="dropdown-title-close">
                                                        <h4>Edit Attachment</h4>
                                                        <span class="close">&times;</span>
                                                      </div>
                                                      <form action="/attachment-edit/{{ $attachment->id }}" method="POST" enctype="multipart/form-data">
                                                          @csrf
                                                          @method('PUT')
                                                          <label for="image">Only upload images with jpeg, jpg and png types!</label>
                                                          <input type="file" name="image" id="image" value="{{ $attachment->image }}">
                                                          <button type="submit" class="submit-btn">Save</button>      
                                                      </form>
                                                      <form action="/attachment-delete/{{ $attachment->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="delete-btn">Delete</button>
                                                      </form>                        
                                                    </div>
                                                  </div>
                                                <img src="{{ asset($attachment->image) }}">
                                                <p class="text-small">Image: {{ basename($attachment->image) }}</p>

                                            </div>
                                            @endif
                                            @if (empty($attachment->link))

                                            @else
                                            <div class="attachment-link-container">
                                                <div class="dropdown label-edit attachment">
                                                    <button class="link">
                                                        <div class="attachment-link-icon">
                                                            <i class="fa-solid fa-link"></i>
                                                        </div>        
                                                    </button>
                                                    <div class="dropdown-menu label dropdown-color">
                                                        <div class="dropdown-title-close">
                                                          <h4>Edit attachment</h4>
                                                          <span class="close">&times;</span>
                                                        </div>
                                                        {{-- attachment link modal --}}
                                                        <form action="/attachment-edit/{{ $attachment->id }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            {{-- <input type="text" name="link" id="link" > --}}
                                                            <label for="link">Uploaded Link</label>
                                                            <input type="text" name="link" id="link" value="{{ $attachment->link }}">
                                                            <label for="link">Display Text</label>
                                                            <input type="text" name="link_display" id="link_display" value="{{ $attachment->link_display }}">
                                                            <button type="submit" class="submit-btn">Save</button>      
                                                        </form>
                                                        <form action="/attachment-delete/{{ $attachment->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="delete-btn">Delete</button>
                                                        </form>
                                                      </div>
                                                </div>
                                                <a href="{{ $attachment->link }}" class="attachment-link"><p>{{ $attachment->link_display }}</p></a>
                                            </div>
                                            @endif
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
                                                <div class="modal-user-comment">
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
                                                    <div class="user-comment">
                                                        <h5>{{ $comment->user->name }}</h5>
                                                        <p class="comment-result" onclick="toggleEdit(this)">{{ $comment->comment }}</p>
                                                        <form action="/comment-edit/{{ $comment->id }}" method="POST" >
                                                            @csrf
                                                            @method('PUT')
                                                            <textarea name="comment">{{ $comment->comment }}</textarea>
                                                            <button type="submit">Send</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="profile-comment">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="">
                                                <form action="/comment-create" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                                                    <textarea name="comment" placeholder="Comment here...."></textarea>
                                                    <button type="submit">Send</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-detail-buttons">
                                        <div class="dropdown">
                                            <button class="link">Assign</button>
                                            <div class="dropdown-menu label-modal dropdown-color">
                                                <div class="dropdown-title-close">
                                                    <h4>Assign This Task Item To</h4>
                                                    <span class="close">&times;</span>
                                                </div>
                                                <form action="/assign-create" method="POST" class="color-container">
                                                    @csrf
                                                    <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                                                    <input type="hidden" name="task_id" value="">
                                                    <select name="user">
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->name }}"> {{ $user->name }} </option>
                                                    @endforeach
                                                    </select>
                                                    <button type="submit">Save</button>
                                                </form>
                                            </div>
                                        </div>
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
                                        <div class="dropdown">
                                            <button class="link">Due Date</button>
                                            <div class="dropdown-menu background">
                                                <div class="dropdown-title-close">
                                                    <h4>Task Due Date</h4>
                                                    <span class="close">&times;</span>
                                                </div>
                                                @if ($taskitem->schedules->where('task_item_id', $taskitem->id)->isEmpty())
                                                    <form action="/schedule-component-create" method="POST">
                                                        @csrf
                                                        <input type="text" id="title" name="title" value="{{ $taskitem->title }}" style="display: none">
                                                        <input type="hidden" name="workspace_id" value="{{ $taskitem->tasks->board->workspace->id }}">
                                                        <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                                                        <input type="hidden" value="gradient-blue" name="background_color">
                                                        <input type="datetime-local" id="start-date" name="start" style="display: none">
                                                        <input type="datetime-local" id="end-date" name="end">
                                                        <button type="submit">Save</button>
                                                    </form>
                                                @else
                                                    @foreach ($taskitem->schedules as $schedule)
                                                        <form action="/schedule-edit/{{ $schedule->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="text" id="title" name="title" value="{{ $taskitem->title }}" style="display: none">
                                                            <input type="hidden" value="gradient-blue" name="background_color">
                                                            <input type="datetime-local" id="start-date" name="start" style="display: none">
                                                            <input type="datetime-local" name="end" value="{{ $schedule->end }}">
                                                            <button type="submit">Submit</button>
                                                        </form>
                                                    @endforeach
                                                @endif
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
        function getLocalDatetimeString(date) {
            var year = date.getFullYear();
            var month = ("0" + (date.getMonth() + 1)).slice(-2);
            var day = ("0" + date.getDate()).slice(-2);
            var hours = "00";
            var minutes = "00";
            return `${year}-${month}-${day}T${hours}:${minutes}`;
        }
        var today = new Date();
        var tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);
        
        var startDateInputs = document.querySelectorAll('input[id^="start-date"]');
        startDateInputs.forEach(function(input) {
            input.value = getLocalDatetimeString(today);
        });
        
        var endDateInputs = document.querySelectorAll('input[id^="end-date"]');
        endDateInputs.forEach(function(input) {
            input.value = getLocalDatetimeString(tomorrow);
        });

        function toggleEdit(element) {
            const form = element.nextElementSibling;
            
            form.style.display = "flex";
            element.style.display = "none";

            document.addEventListener('click', function handleClickOutside(event) {
                if (!form.contains(event.target) && event.target !== element) {
                    form.style.display = "none";
                    element.style.display = "block";
                    document.removeEventListener('click', handleClickOutside);
                }
            });
        }

        // function toggleEdit(element) {
        //     const form = element.nextElementSibling;

        //     if (form.style.display === "none") {
        //         form.style.display = "flex";
        //         element.style.display = "none";
        //     }
        // }

        // function cancelEdit(button) {
        //     const form = button.parentNode;
        //     const commentResult = form.previousElementSibling;

        //     form.style.display = "none";
        //     commentResult.style.display = "block";
        // }

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