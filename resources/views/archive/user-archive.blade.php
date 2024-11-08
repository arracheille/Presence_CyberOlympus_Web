<x-app-layout>
    <h3>User {{ auth()->user()->name }}'s Archived Datas</h3>
    <h4>Archived Workspaces</h4>
    @forelse ($Archived_workspaces->where('user_id', auth()->user()->id) as $workspace)
    <div>
        <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
        <div class="workspace-title-author">
            <h4>{{ $workspace->title }}</h4>
            <p>Created by: <span>{{ $workspace->user->name }}</span></p>
            @if(!is_null($workspace->description) && $workspace->description !== '')
            <p class="text-small">{{ $workspace->description }}</p>
            @endif
            <p class="text-small">{{ $workspace->type }}</p>
        </div>
        <div class="restore-delete">
            <form action="/restore-workspace/{{ $workspace->id }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $workspace->id }}">
                <input type="hidden" name="unique_code" value="{{ $workspace->unique_code }}">
                <button class="btn-small gradient-v-green" type="submit"><p class="text-small">Restore</p></button>
            </form>
            <form action="/delete-workspace/{{ $workspace->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn-small gradient-v-red"><p class="text-small">Delete Forever</p></button>
            </form>
        </div>
    </div>
    @empty
    <p>You don't have an archived Workspace yet!</p>
    @endforelse
    <h4>Archived Boards</h4>
    <div class="wrapper">
        <div class="board-container">
            @forelse ($Archived_boards->where('user_id', auth()->user()->id) as $board)
            @php
                $board_color = match ($board['background_color']) {
                    'gradient-orange' => 'gradient-orange',
                    'gradient-blue' => 'gradient-blue',
                    'gradient-green' => 'gradient-green',
                    'gradient-red' => 'gradient-red',
                    'gradient-pink' => 'gradient-pink',
                    'gradient-purple' => 'gradient-purple',
                    default => 'darkblue',
                };
            @endphp
            <div class="content-board center" id="{{ $board_color }}">
                <p>{{ $board['title'] }}</p>
                <div class="content-board-crud">
                    <form action="/restore-board/{{ $board->id }}" method="POST">
                        @csrf
                        <button class="board-delete gradient-v-green">Restore</button>
                    </form>
                    <form action="/delete-board/{{ $board->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="board-delete gradient-v-red" type="submit">Delete Forever</button>
                    </form>
                </div>
            </div>
            @empty
            <p>You don't have an archived Board yet!</p>
            @endforelse
        </div>
    </div>
    <h4>Archived Tasks</h4>
    <div class="wrapper" id="to-do-list-container">
        <div class="task-container" id="to-do-body">
            @forelse ($Archived_tasks->where('user_id', auth()->user()->id) as $task)
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
            <div class="content-task to-do-card-drag" id="{{ $task_color }}">
                <div class="content-task-top to-do-card-content">
                    <h4>{{ $task['title'] }}</h4>
                    <p>Created by: {{ $task->user->name }}</p>
                </div>
                <div class="restore-delete">
                    <form action="/task-restore/{{ $task->id }}" method="POST">
                        @csrf
                        <button class="btn-small gradient-v-green" type="submit"><p class="text-small">Restore</p></button>
                    </form>
                    <form action="/task-delete/{{ $task->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn-small gradient-v-red"><p class="text-small">Delete Forever</p></button>
                    </form>
                </div>
            </div>
            @empty
            <p>You don't have an archived Task yet!</p>
            @endforelse
        </div>
    </div>
    <h4>Archived Task Items</h4>
    <div class="wrapper" id="to-do-list-container">
        <div class="task-container" id="to-do-body">
            @forelse ($Archived_taskitems as $taskitem)
            @php
            $task_color = match ($taskitem->tasks['background_color']) {
                'gradient-orange' => 'gradient-orange',
                'gradient-blue' => 'gradient-blue',
                'gradient-green' => 'gradient-green',
                'gradient-red' => 'gradient-red',
                'gradient-pink' => 'gradient-pink',
                'gradient-purple' => 'gradient-purple',
                default => 'darkblue',
            };
            @endphp
            <div class="content-task to-do-card-drag" id="{{ $task_color }}">
                <div class="content-task-top to-do-card-content">
                    <h4>{{ $taskitem->tasks->title }}</h4>
                    <p>Created by: {{ $taskitem->tasks->user->name }}</p>
                </div>
                
                <div class="task-item-container">
                    <div class="content-task-item to-do-card-content" id="to-do-card-item">
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
                        <div class="restore-delete">
                            <form action="/task-item-restore/{{ $taskitem->id }}" method="POST">
                                @csrf
                                <button class="btn-small gradient-v-green" type="submit"><p class="text-small">Restore</p></button>
                            </form>
                            <form action="/task-item-delete/{{ $taskitem->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-small gradient-v-red"><p class="text-small">Delete Forever</p></button>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            @empty
                <p>You don't have an archived Task Item Yet!</p>
            @endforelse
        </div>
    </div>
    <h4>Archived Schedules</h4>
    <div id="calendar"></div>

    @foreach ($Archived_schedules as $schedule)
    <div id="scheduleResDelModal-{{ $schedule->id }}" class="modal schedule-res-del">
        <div class="modal-content">
            <div class="modal-title-close">
                <h4>Schedule {{ $schedule->title }}</h4>
                <span class="close" onclick="closescheduleResDel({{ $schedule->id }})">&times;</span>
            </div>
            <p class="text-small">From workspace <span>{{ $schedule->workspace->title }}</span></p>
            <form action="/schedule-restore/{{ $schedule->id }}" method="POST">
                @csrf
                <button type="submit" class="delete-green gradient-h-green">Restore</button>
            </form>
            <form action="/schedule-delete/{{ $schedule->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Archive</button>
            </form>
        </div>
    </div>
    @endforeach

    <script src="{{ asset('fullcalendar-6.1.15/dist/index.global.js') }}"></script>
    <script>
        function openscheduleResDel(id) {
            document.getElementById('scheduleResDelModal-' + id).style.display = 'block';
        }

        function closescheduleResDel(id) {
            document.getElementById('scheduleResDelModal-' + id).style.display = 'none';
        }

        document.addEventListener("DOMContentLoaded", function () {
            var calendarEl = document.getElementById("calendar");

            var today = new Date();
            var formattedToday = today.toISOString().slice(0, 10);

            var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,timeGridWeek,timeGridDay",
            },
            initialDate: formattedToday,
            navLinks: true,
            selectable: true,
            selectMirror: true,
            select: function (arg) {
                var startDate = new Date(arg.startStr);
                var endDate = new Date(arg.endStr);
                var startDateString = startDate.toISOString().slice(0, 16);
                var endDateString = endDate.toISOString().slice(0, 16);
                document.getElementById('start-date').value = startDateString;
                document.getElementById('end-date').value = endDateString;

                openAddscheduleresdel();
                calendar.unselect();
            },
            eventClick: function (arg) {
                var scheduleId = arg.event.id;
                openscheduleResDel(scheduleId);
            },
            editable: false,
            dayMaxEvents: true,
            events: @json($Archived_schedules),
            eventDidMount: function(info) {
                var backgroundColorId = info.event.extendedProps.background_color;
                if (backgroundColorId) {
                    info.el.id = backgroundColorId;
                }
            }
            });
            calendar.render();
        });
    </script>
</x-app-layout>