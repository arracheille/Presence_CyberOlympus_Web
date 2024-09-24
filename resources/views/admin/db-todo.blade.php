<x-app-layout>
  @include('admin.css')
  <h3>User To-Dos</h3>
  <div class="filters">
    <form>
      <input type="text" id="filter-board-task" name="filter-board-task" placeholder="Search..." />
      <button type="submit">Filter</button>
    </form>
  </div>
  @if ($boards->isEmpty())
  <p>No Boards Yet.</p>
  @else
  <div class="wrapper">
    <table class="admin-table">
      <thead>
        <tr>
          <th class="admin-th-todo text-center">Board</th>
          <th>Tasks</th>
        </tr>
      </thead>
      <tbody class="tbody-board">
        @foreach ($boards as $board)
        <tr>
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
          <td class="admin-th-todo text-center" id="{{ $board_color }}"><h4>{{ $board->title }}</h4></td>
          <td>
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
                      <p>{{ $taskitem->description }}</p>
                    </div>
                    @endforeach
                  </div>
                </div>
                @endforeach
              </div>  
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</x-app-layout>
