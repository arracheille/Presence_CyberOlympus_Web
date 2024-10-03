<x-app-layout>
    <div class="workspace">
        <div class="task-info">
            <div class="task-desc">
                <h3>Workspaces</h3>
            </div>
            <div class="task-share">
                <div class="dropdown">
                    <button class="link gradient-h-blue">Join Workspace</button>
                    <div class="dropdown-menu ">
                        <div class="dropdown-title-close">
                            <h4>Join Workspace</h4>
                            <span class="close">&times;</span>
                        </div>
                        <form action="{{ route('workspaces.join') }}" method="post">
                            @csrf
                            <input type="text" class="input-join" name="unique_code" id="unique_code" placeholder="Paste Here...">
                            <button type="submit" class="">Join</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-board add-board" onclick="openAddWorkspace()">
            <p><i class="fa-solid fa-plus"></i> Add New Workspace</p>
        </div>
        <div class="workspace-container">
            @foreach ($workspacesList as $workspace)
                <div class="workspace-content">
                    <div class="workspace-title">
                        <a href="{{ url('/workspace/' . $workspace->workspace->id) }}">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
                            <div class="workspace-title-author">
                                <h4>{{ $workspace->workspace->title }}</h4>
                                <p>Created by: <span>{{ $workspace->workspace->user->name }}</span></p>
                                @if(!is_null($workspace->description) && $workspace->description !== '')
                                <p class="text-small">{{ $workspace->workspace->description }}</p>
                                @endif
                                <p class="text-small">{{ $workspace->workspace->type }}</p>
                            </div>
                        </a>
                        <div class="task-share workspace">
                            <div class="dropdown">
                                <button class="link">Share Workspace</button>
                                <div class="dropdown-menu ">
                                    <div class="dropdown-title-close">
                                        <h4>Workspace Link</h4>
                                        <span class="close">&times;</span>
                                    </div>
                                    <div class="result-container">
                                        <input type="text" value="{{ $workspace->unique_code }}" class="filter" id="share_url" placeholder="Filter Posts" readonly>
                                        <button class="btn ctoCb" id="clipboard">
                                            <i class="far fa-clipboard"></i>
                                        </button>
                                    </div>
                                    <p>Or invite user from email</p>
                                    <form action="/send-w-code" method="POST">
                                        @csrf
                                        <input type="hidden" name="unique_code" value="{{ $workspace->unique_code }}">
                                        <input type="email" class="input-join" name="email" placeholder="Example: acwel@gmail.com" required>
                                        <button type="submit">Send Invitation</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper">
                        <div class="board-container">
                            @foreach ($workspace->workspace->boards as $board)
                            @if ($board->visibility === 'private' && $board->user_id === auth()->user()->id)
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
                                    <a href="/board-task/{{ $board->id }}">
                                    <p>{{ $board['title'] }}</p>
                                    </a>
                                    <div class="content-board-crud">
                                        <button class="board-edit gradient-v-blue" onclick="openEditboard({{ $board->id }})">Edit</button>
                                        <form action="/delete-board/{{ $board->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="board-delete gradient-v-red">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @elseif ($board->visibility !== 'private')
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
                                    <a href="/board-task/{{ $board->id }}">
                                    <p>{{ $board['title'] }}</p>
                                    </a>
                                    <div class="content-board-crud">
                                        <button class="board-edit gradient-v-blue" onclick="openEditboard({{ $board->id }})">Edit</button>
                                        <form action="/delete-board/{{ $board->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="board-delete gradient-v-red">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div id="editBoardmodal-{{ $board->id }}" class="modal">
                                <div class="modal-content">
                                    <div class="modal-title-close">
                                        <h2>Edit Board <span>{{ $board->title }}</span></h2>
                                        <span class="close" onclick="closeEditboard({{ $board->id }})">&times;</span>
                                    </div>
                                    <form action="/edit-board/{{ $board->id }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" id="editBoardid-{{ $board->id }}" name="id">
                                        <label for="title">Title :</label>
                                        <input type="text" name="title" value="{{ $board->title }}">
                                        <button class="submit-btn">Submit</button>
                                    </form>
                                </div>
                            </div>
                          @endforeach
                          <div class="content-board add-board" onclick="openAddboard()">
                              <p><i class="fa-solid fa-plus"></i> Add New Board</p>
                            </div>  
                        </div>
                    </div>
                </div>
                <div id="addboardModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-title-close">
                            <h3>Add New Board</h3>
                            <span class="close" onclick="closeAddboard()">&times;</span>
                        </div>
                        <form action="/create-board" method="POST">
                            @csrf
                            <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
                            <input type="text" name="title">
                            <h4>Choose Background Color</h4>
                            <div class="grid-color">
                                <input type="radio" id="option-boards-1" name="background_color" value="gradient-orange" checked/>
                                <label for="option-boards-1" class="radio-button color" id="gradient-orange"></label>
                                <input type="radio" id="option-boards-2" name="background_color" value="gradient-red" />
                                <label for="option-boards-2" class="radio-button color" id="gradient-red"></label>
                                <input type="radio" id="option-boards-3" name="background_color" value="gradient-blue" />
                                <label for="option-boards-3" class="radio-button color" id="gradient-blue"></label>
                                <input type="radio" id="option-boards-4" name="background_color" value="gradient-green" />
                                <label for="option-boards-4" class="radio-button color" id="gradient-green"></label>
                                <input type="radio" id="option-boards-5" name="background_color" value="gradient-pink" />
                                <label for="option-boards-5" class="radio-button color" id="gradient-pink"></label>
                                <input type="radio" id="option-boards-6" name="background_color" value="gradient-purple" />
                                <label for="option-boards-6" class="radio-button color" id="gradient-purple"></label>
                            </div>        
                            <div class="modal-footer">
                                <button class="submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
            {{-- @if (auth()->user()->usertype == 'superadmin')
            @foreach ($workspacesList as $workspace)
                <div class="workspace-content">
                    <a href="/workspace/{{ $workspace->id }}">
                        <div class="workspace-title">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
                            <div class="workspace-title-author">
                                <h4>{{ $workspace->title }}</h4>
                                <p>Created by: <span>{{ $workspace->user->name }}</span></p>
                                @if(!is_null($workspace->description) && $workspace->description !== '')
                                <p class="text-small">{{ $workspace->description }}</p>
                                @endif
                                <p class="text-small">{{ $workspace->type }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="wrapper">
                        <div class="board-container">
                          @if (auth()->user()->usertype == 'superadmin')
                              @foreach ($workspace->boards as $board)
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
                                    $board_color = "white";
                                    }
                                @endphp
                                <div class="content-board center" id="{{ $board_color }}">
                                    <a href="/board-task/{{ $board->id }}">{{ $board['title'] }}</a>
                                    <div class="content-board-crud">
                                        <button class="board-edit gradient-v-blue" onclick="openEditboard({{ $board->id }})">Edit</button>
                                        <form action="/delete-board/{{ $board->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="board-delete gradient-v-red">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div id="editBoardmodal-{{ $board->id }}" class="modal">
                                    <div class="modal-content">
                                        <div class="modal-title-close">
                                            <h2>Edit Board <span>{{ $board->title }}</span></h2>
                                            <span class="close" onclick="closeEditboard({{ $board->id }})">&times;</span>
                                        </div>
                                        <form action="/edit-board/{{ $board->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="editBoardid-{{ $board->id }}" name="id">
                                            <label for="title">Title :</label>
                                            <input type="text" name="title" value="{{ $board->title }}">
                                            <button class="submit-btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                              @endforeach
                          @else
                              @foreach ($workspace->boards->where('user_id', auth()->user()->id) as $board)
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
                                  $board_color = "white";
                                  }
                              @endphp
                              <div class="content-board center" id="{{ $board_color }}">
                                  <a href="/board-task/{{ $board->id }}">{{ $board['title'] }}</a>
                                  <div class="content-board-crud">
                                      <button class="board-edit gradient-v-blue" onclick="openEditboard({{ $board->id }})">Edit</button>
                                      <form action="/delete-board/{{ $board->id }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button class="board-delete gradient-v-red">Delete</button>
                                      </form>
                                  </div>
                              </div>
                              <div id="editBoardmodal-{{ $board->id }}" class="modal">
                                  <div class="modal-content">
                                      <div class="modal-title-close">
                                          <h2>Edit Board <span>{{ $board->title }}</span></h2>
                                          <span class="close" onclick="closeEditboard({{ $board->id }})">&times;</span>
                                      </div>
                                      <form action="/edit-board/{{ $board->id }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <input type="hidden" id="editBoardid-{{ $board->id }}" name="id">
                                          <label for="title">Title :</label>
                                          <input type="text" name="title" value="{{ $board->title }}">
                                          <button class="submit-btn">Submit</button>
                                      </form>
                                  </div>
                              </div>
                              @endforeach
                          @endif
                          <div class="content-board add-board" onclick="openAddboard()">
                              <p><i class="fa-solid fa-plus"></i> Add New Board</p>
                            </div>  
                        </div>
                    </div>
                </div>
                <div id="addboardModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-title-close">
                            <h3>Add New Board</h3>
                            <span class="close" onclick="closeAddboard()">&times;</span>
                        </div>
                        <form action="/create-board" method="POST">
                            @csrf
                            <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
                            <input type="text" name="title">
                            <h4>Choose Background Color</h4>
                            <div class="grid-color">
                                <input type="radio" id="option-boards-1" name="background_color" value="gradient-orange" checked/>
                                <label for="option-boards-1" class="radio-button color" id="gradient-orange"></label>
                                <input type="radio" id="option-boards-2" name="background_color" value="gradient-red" />
                                <label for="option-boards-2" class="radio-button color" id="gradient-red"></label>
                                <input type="radio" id="option-boards-3" name="background_color" value="gradient-blue" />
                                <label for="option-boards-3" class="radio-button color" id="gradient-blue"></label>
                                <input type="radio" id="option-boards-4" name="background_color" value="gradient-green" />
                                <label for="option-boards-4" class="radio-button color" id="gradient-green"></label>
                                <input type="radio" id="option-boards-5" name="background_color" value="gradient-pink" />
                                <label for="option-boards-5" class="radio-button color" id="gradient-pink"></label>
                                <input type="radio" id="option-boards-6" name="background_color" value="gradient-purple" />
                                <label for="option-boards-6" class="radio-button color" id="gradient-purple"></label>
                            </div>        
                            <div class="modal-footer">
                                <button class="submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
            @else
            @foreach ($workspacesList->where('user_id', auth()->user()->id) as $workspace)
                <div class="workspace-content">
                    <a href="/workspace/{{ $workspace->id }}">
                        <div class="workspace-title">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
                            <div class="workspace-title-author">
                                <h4>{{ $workspace->title }}</h4>
                                <p>Created by: <span>{{ $workspace->user->name }}</span></p>
                                @if(!is_null($workspace->description) && $workspace->description !== '')
                                <p class="text-small">{{ $workspace->description }}</p>
                                @endif
                                <p class="text-small">{{ $workspace->type }}</p>
                            </div>
                        </div>
                    </a>
                    <div class="wrapper">
                        <div class="board-container">
                          @if (auth()->user()->usertype == 'superadmin')
                              @foreach ($workspace->workspace->boards as $board)
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
                                    $board_color = "white";
                                    }
                                @endphp
                                <div class="content-board center" id="{{ $board_color }}">
                                    <a href="/board-task/{{ $board->id }}">{{ $board['title'] }}</a>
                                    <div class="content-board-crud">
                                        <button class="board-edit gradient-v-blue" onclick="openEditboard({{ $board->id }})">Edit</button>
                                        <form action="/delete-board/{{ $board->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="board-delete gradient-v-red">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <div id="editBoardmodal-{{ $board->id }}" class="modal">
                                    <div class="modal-content">
                                        <div class="modal-title-close">
                                            <h2>Edit Board <span>{{ $board->title }}</span></h2>
                                            <span class="close" onclick="closeEditboard({{ $board->id }})">&times;</span>
                                        </div>
                                        <form action="/edit-board/{{ $board->id }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="editBoardid-{{ $board->id }}" name="id">
                                            <label for="title">Title :</label>
                                            <input type="text" name="title" value="{{ $board->title }}">
                                            <button class="submit-btn">Submit</button>
                                        </form>
                                    </div>
                                </div>
                              @endforeach
                          @else
                              @foreach ($workspace->workspace->boards->where('user_id', auth()->user()->id) as $board)
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
                                  $board_color = "white";
                                  }
                              @endphp
                              <div class="content-board center" id="{{ $board_color }}">
                                  <a href="/board-task/{{ $board->id }}">{{ $board['title'] }}</a>
                                  <div class="content-board-crud">
                                      <button class="board-edit gradient-v-blue" onclick="openEditboard({{ $board->id }})">Edit</button>
                                      <form action="/delete-board/{{ $board->id }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button class="board-delete gradient-v-red">Delete</button>
                                      </form>
                                  </div>
                              </div>
                              <div id="editBoardmodal-{{ $board->id }}" class="modal">
                                  <div class="modal-content">
                                      <div class="modal-title-close">
                                          <h2>Edit Board <span>{{ $board->title }}</span></h2>
                                          <span class="close" onclick="closeEditboard({{ $board->id }})">&times;</span>
                                      </div>
                                      <form action="/edit-board/{{ $board->id }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <input type="hidden" id="editBoardid-{{ $board->id }}" name="id">
                                          <label for="title">Title :</label>
                                          <input type="text" name="title" value="{{ $board->title }}">
                                          <button class="submit-btn">Submit</button>
                                      </form>
                                  </div>
                              </div>
                              @endforeach
                          @endif
                          <div class="content-board add-board" onclick="openAddboard()">
                              <p><i class="fa-solid fa-plus"></i> Add New Board</p>
                            </div>  
                        </div>
                    </div>
                </div>
                <div id="addboardModal" class="modal">
                    <div class="modal-content">
                        <div class="modal-title-close">
                            <h3>Add New Board</h3>
                            <span class="close" onclick="closeAddboard()">&times;</span>
                        </div>
                        <form action="/create-board" method="POST">
                            @csrf
                            <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
                            <input type="text" name="title">
                            <h4>Choose Background Color</h4>
                            <div class="grid-color">
                                <input type="radio" id="option-boards-1" name="background_color" value="gradient-orange" checked/>
                                <label for="option-boards-1" class="radio-button color" id="gradient-orange"></label>
                                <input type="radio" id="option-boards-2" name="background_color" value="gradient-red" />
                                <label for="option-boards-2" class="radio-button color" id="gradient-red"></label>
                                <input type="radio" id="option-boards-3" name="background_color" value="gradient-blue" />
                                <label for="option-boards-3" class="radio-button color" id="gradient-blue"></label>
                                <input type="radio" id="option-boards-4" name="background_color" value="gradient-green" />
                                <label for="option-boards-4" class="radio-button color" id="gradient-green"></label>
                                <input type="radio" id="option-boards-5" name="background_color" value="gradient-pink" />
                                <label for="option-boards-5" class="radio-button color" id="gradient-pink"></label>
                                <input type="radio" id="option-boards-6" name="background_color" value="gradient-purple" />
                                <label for="option-boards-6" class="radio-button color" id="gradient-purple"></label>
                            </div>        
                            <div class="modal-footer">
                                <button class="submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
            @endif --}}
        </div>
        <div id="addWorkspaceModal" class="modal">
            <div class="modal-content">
                <div class="modal-title-close">
                    <h3>Add New Workspace</h3>
                    <span class="close" onclick="closeAddWorkspace()">&times;</span>
                </div>
                <form action="/create-workspace" method="POST">
                    @csrf
                    {{-- <input type="hidden" name="unique_code" value="a"> --}}
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <label for="title">Workspace Title</label>
                    <input type="text" id="title" name="title">
                    <label for="type">Workspace Type</label>
                    <select id="type" name="type">
                        <option value="Personal">Personal</option>
                        <option value="IT">IT</option>
                        <option value="Marketing">Marketing</option>
                        <option value="Education">Education</option>
                        <option value="Sales">Sales</option>
                        <option value="Other">Other</option>
                    </select>
                    <label for="description">Workspace Description (Optional)</label>
                    <textarea name="description" id="description"></textarea>
                    <div class="modal-footer">
                        <button class="submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
      </div>
      @include('components.dropdownform')
      @include('components.btn-copy')
    <script>
        function openAddWorkspace() {
        document.getElementById('addWorkspaceModal').style.display = 'block';
        }
    
        function closeAddWorkspace() {
        document.getElementById('addWorkspaceModal').style.display = 'none';
        }

        function openAddboard() {
        document.getElementById('addboardModal').style.display = 'block';
        }
    
        function closeAddboard() {
        document.getElementById('addboardModal').style.display = 'none';
        }

        function openEditboard(id) {
            document.getElementById('editBoardmodal-' + id).style.display = 'block';
            document.getElementById('editBoardid-' + id).value = id;
        }

        function closeEditboard(id) {
            document.getElementById('editBoardmodal-' + id).style.display = 'none';
        }
    </script>  
</x-app-layout>