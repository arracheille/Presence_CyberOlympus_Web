<x-app-layout>
    @include('admin.css')
    <div class="user-details">
        <div class="user-attendance-board">
            <div class="user-attendance-details">
                <div class="user-details-container content">
                    <h4>Username: {{ $user->name }}</h4>
                    <p>User Email Address: {{ $user->email }}</p>
                    <p>User Role: {{ $user->usertype }}</p>
                    <p>Account Created At: {{ $user->created_at }}</p>
                </div>
                <div class="user-attendance-container content">
                    <div class="user-attendance">
                        <div class="attendance-warning"><p class="gradient-text-green"><i class="fa-solid fa-circle-exclamation"></i> User {{ $user->name }} Have Checked-In</p></div>
                    </div>
                    <div class="user-attendance">
                        <div class="attendance-warning"><p class="gradient-text-red"><i class="fa-solid fa-circle-exclamation"></i> User {{ $user->name }} Haven't Checked-Out</p></div>
                    </div>
                </div>
            </div>
            <div class="user-boards-tasks">
                <h4>User {{ $user->name }} Boards & Tasks</h4>
                @if ($user->boards->isEmpty())
                    <p>{{ $user->name }} Hasn't Create A Schedule Yet.</p>
                @else
                    @foreach ($user->boards as $board)
                        @php
                            if ($board['background_color'] == 'gradient-orange') {
                            $board_color = "gradient-orange";
                            }elseif ($board['background_color'] == 'gradient-blue') {
                            $board_color = "gradient-blue";
                            }elseif ($board['background_color'] == 'gradient-green') {
                            $board_color = "gradient-green";
                            }elseif ($board['background_color'] == 'gradient-red') {
                            $board_color = "gradient-red";
                            }elseif ($board['background_color'] == 'gradient-pink') {
                            $board_color = "gradient-pink";
                            }elseif ($board['background_color'] == 'gradient-purple') {
                            $board_color = "gradient-purple";
                            }else{
                            $board_color = "darkblue";
                            }
                        @endphp
                        <a href="/board-task/{{ $board->id }}" class="user-board-content" id="{{ $board_color }}">{{ $board['title'] }}</a>
                        <div class="wrapper">
                            <div class="task-container">
                                @foreach ($board->tasks as $task)
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
                                    $task_color = "darkblue";
                                    }
                                @endphp
                                <div class="content-task" id="{{ $task_color }}">
                                    <div class="content-task-top to-do-card-content">
                                        <h4>{{ $task['title'] }}</h4>
                                        <p>Created by: {{ $task->user->name }}</p>
                                    </div>
                                    <div class="task-item-container">
                                        @foreach ($task->taskitems as $taskitem)
                                        <div class="content-task-item to-do-card-content">
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
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>  
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="user-detail-schedule">
            <h4>User {{ $user->name }} Schedules</h4>
            @if($user->schedules->isEmpty())
                <p>{{ $user->name }} Hasn't Create A Schedule Yet.</p>
            @else
                @foreach ($user->schedules as $schedule)
                @php
                if ($schedule['background_color'] == 'gradient-orange') {
                $color = "gradient-orange";
                }elseif ($schedule['background_color'] == 'gradient-blue') {
                $color = "gradient-blue";
                }elseif ($schedule['background_color'] == 'gradient-green') {
                $color = "gradient-green";
                }elseif ($schedule['background_color'] == 'gradient-red') {
                $color = "gradient-red";
                }elseif ($schedule['background_color'] == 'gradient-pink') {
                $color = "gradient-pink";
                }elseif ($schedule['background_color'] == 'gradient-purple') {
                $color = "gradient-purple";
                }else{
                $color = "darkblue";
                }
                @endphp
                <div class="content" id="{{ $color }}">
                <h4>{{ $schedule->title }}</h4>
                <p>{{ \Carbon\Carbon::parse($schedule->start)->format('l, F j, Y H:i') }} - {{ \Carbon\Carbon::parse($schedule->end)->format('l, F j, Y H:i') }}</p>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</x-app-layout>
  