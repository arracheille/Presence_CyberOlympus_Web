<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="task">
        <div class="task-info">
            <div class="task-desc">
                <h2>{{ $board->title }}</h2>
                <p>From workspace <strong>{{ $board->workspace->title }}</strong></p>
            </div>
            <div class="task-share">
                <form action="{{ route('favorite', $board->id) }}" method="POST" class="star-form">
                    @csrf
                    <input type="checkbox" id="checkbox-fav" onclick="toggleFavorite(this)" {{ auth()->user()->favorites()->where('board_id', $board->id)->exists() ? 'checked' : '' }}>
                    <label for="checkbox-fav">
                        <div class="starred"><i class="fa-solid fa-star"></i></div>
                        <div class="unstar"><i class="fa-regular fa-star"></i></div>
                    </label>
                </form>
                <div class="dropdown">
                    <button class="link gradient-h-blue">Filter</button>
                    <div class="dropdown-menu label-modal dropdown-color"">
                        <div class="dropdown-title-close">
                            <h4>Filter Task & Task Item</h4>
                            <span class="close">&times;</span>
                        </div>
                        <div class="filter-item bytext color-container">
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
                    
                    @include('modals.task-taskitem.edit-task')

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
                        
                            @include('taskitem.view-label-components')

                        </div>
                        <div id="editTaskItemModal-{{ $taskitem->id }}" class="modal">
                            <div class="modal-content">
                                <div class="modal-title-close" id="modal-background">
                                    <div class="title-fav">
                                        <h2>Edit Task Item</h2>
                                        <form action="{{ route('task-item.favorite', $taskitem->id) }}" method="POST" class="star-form">
                                            @csrf
                                            <input type="checkbox" id="checkbox-task-item-fav-{{ $taskitem->id }}" data-task-item-id="{{ $taskitem->id }}" onclick="toggleFavoriteTaskItem(this)" {{ auth()->user()->favorite_taskitems()->where('task_item_id', $taskitem->id)->exists() ? 'checked' : '' }}>
                                            <label for="checkbox-task-item-fav-{{ $taskitem->id }}">
                                                <div class="starred"><i class="fa-solid fa-star"></i></div>
                                                <div class="unstar"><i class="fa-regular fa-star"></i></div>
                                            </label>
                                        </form>                        
                                    </div>
                                    <span class="close" onclick="closeEdittaskitem({{ $taskitem->id }})">&times;</span>
                                </div>
                                <div class="modal-details">
                                    <div class="modal-details-content">
                                        <div class="modal-details-assign">
                                            <p>From Task <strong>{{ $taskitem->tasks->title }}</strong></p>
                                            @if ($taskitem->assigns->isEmpty())
                                            @else
                                                <p>
                                                    This Task Item is Assigned to 
                                                    <span>{{ $taskitem->assigns->pluck('user')->implode(', ') }}</span>
                                                </p>
                                            @endif
                                                
                                            @if ($taskitem->taskitem_members->isEmpty())
                                            @else
                                            <div class="taskitem-member-lists">
                                                <p>Members</p>    
                                                <div class="modal-details-members-icon">
                                                    @foreach ($taskitem->taskitem_members as $taskitem_member)
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($taskitem_member->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon-small" alt="Avatar">
                                                    @endforeach
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        
                                        @include('taskitem.view-edit-label')
                                        
                                        @include('taskitem.view-edit-due-date')
                                        
                                        @include('taskitem.view-edit-create-check-checklist')

                                        @include('taskitem.view-edit-attachment')
                                        
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
                                        
                                        @include('taskitem.create-edit-comment')

                                        @include('taskitem.view-logs')

                                    </div>

                                        <div class="modal-detail-buttons">

                                            @include('taskitem.create-assign')

                                            @include('taskitem.create-label')

                                            @include('taskitem.create-edit-background')

                                            @include('taskitem.create-due-date')

                                            @include('taskitem.create-check')

                                            @include('taskitem.create-attach')

                                            <form id="delete-form-{{ $taskitem->id }}" action="/task-item-delete/{{ $taskitem->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="delete-btn" onclick="confirmDelete('delete-form-{{ $taskitem->id }}')">Archive</button>
                                            </form>

                                            <hr>

                                            @forelse ($taskitem->taskitem_members->where('user_id', auth()->user()->id) as $taskitem_member)
                                                <form action="/taskitem-member-leave/{{ $taskitem_member->id }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete-btn">Leave</button>
                                                </form>
                                            @empty
                                                <form action="/taskitem-member-create" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="task_item_id" value="{{ $taskitem->id }}">
                                                    <button>Join</button>
                                                </form>
                                            @endforelse
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
                    <div class="content-task add-task" onclick="openAddtask({{ Request::segment(4) }})">
                        <p><i class="fa-solid fa-plus"></i> Add New task</p>
                    </div>
                </div>
            </div>
        </div>

    @include('modals.task-taskitem.add-task')
    
    @include('modals.task-taskitem.add-task-item')

    @include('components.sortabletaskitem')

    @include('components.sortabletask')

    @include('components.dropdownform')

    @include('components.jquery')

    @include('scripts.favorite-board')

    @include('scripts.favorite-task')

    @include('scripts.favorite-task-item')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.3/Sortable.min.js" integrity="sha512-8AwTn2Tax8NWI+SqsYAXiKT8jO11WUBzTEWRoilYgr5GWnF4fNqBRD+hCr4JRSA1eZ/qwbI+FPsM3X/PQeHgpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        let id = "{{ request()->query('id') }}"; 
        if(id){
            openEdittaskitem(id)
        }

        function getLocalDatetimeString(date) {
            var year = date.getFullYear();
            var month = ("0" + (date.getMonth() + 1)).slice(-2);
            var day = ("0" + date.getDate()).slice(-2);
            var hours = ("0" + date.getHours()).slice(-2);
            var minutes = ("0" + date.getMinutes()).slice(-2);
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

        function toggleEditCheck(element) {
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

        function ToggleFormEditChecklist(id) {

            const form = document.getElementById('edit-checklist-form' + id);
            const checklistItem = document.getElementById('checklist-item-check' + id);

            if (form && checklistItem) {
                form.style.display = 'flex';
                checklistItem.style.display = 'none';

                document.addEventListener('click', function handleClickOutside(event) {
                    if (!form.contains(event.target) && !event.target.closest('button')) {
                        // Jika klik di luar form dan tombol, sembunyikan form
                        form.style.display = 'none';
                        checklistItem.style.display = 'block';

                        // Hapus event listener setelah form disembunyikan
                        document.removeEventListener('click', handleClickOutside);
                    }
                });
            }
        }

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
        }
    </script>    
</x-app-layout>