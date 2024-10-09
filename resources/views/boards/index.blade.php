<x-app-layout>
    <div class="board">
        <h2>Workspace Boards</h2>
        <p>From workspace <span>{{ $workspace->title }}</span></p>
        {{-- <div class="wrapper"> --}}
          <div class="board-container">
            @foreach ($workspace->boards as $board)
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
                    <a href="{{ url('/workspace' . '/' . $workspace->id . '/board-task' . '/' . $board->id) }}">
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
                    <a href="{{ url('/workspace' . '/' . $workspace->id . '/board-task' . '/' . $board->id) }}">
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
                        <label for="visibility">Board Visibility :</label>
                        <select name="visibility" id="visibility">
                            <option value="allmembers" {{ $board->visibility == 'allmembers' ? 'selected' : '' }}>Visible to all members</option>
                            <option value="private" {{ $board->visibility == 'private' ? 'selected' : '' }}>Private</option>
                        </select>
                        <h4>Choose Background Color</h4>
                        <div class="grid-color">
                            <input type="radio" id="option-board-color-{{ $board->id }}-1" name="background_color" value="gradient-orange"
                                @if($board->background_color == 'gradient-orange') checked @endif />
                            <label for="option-board-color-{{ $board->id }}-1" class="radio-button color" id="gradient-orange"></label>
                            
                            <input type="radio" id="option-board-color-{{ $board->id }}-2" name="background_color" value="gradient-red"
                                @if($board->background_color == 'gradient-red') checked @endif />
                            <label for="option-board-color-{{ $board->id }}-2" class="radio-button color" id="gradient-red"></label>
                            
                            <input type="radio" id="option-board-color-{{ $board->id }}-3" name="background_color" value="gradient-blue"
                                @if($board->background_color == 'gradient-blue') checked @endif />
                            <label for="option-board-color-{{ $board->id }}-3" class="radio-button color" id="gradient-blue"></label>
                            
                            <input type="radio" id="option-board-color-{{ $board->id }}-4" name="background_color" value="gradient-green"
                                @if($board->background_color == 'gradient-green') checked @endif />
                            <label for="option-board-color-{{ $board->id }}-4" class="radio-button color" id="gradient-green"></label>
                            
                            <input type="radio" id="option-board-color-{{ $board->id }}-5" name="background_color" value="gradient-pink"
                                @if($board->background_color == 'gradient-pink') checked @endif />
                            <label for="option-board-color-{{ $board->id }}-5" class="radio-button color" id="gradient-pink"></label>
                            
                            <input type="radio" id="option-board-color-{{ $board->id }}-6" name="background_color" value="gradient-purple"
                                @if($board->background_color == 'gradient-purple') checked @endif />
                            <label for="option-board-color-{{ $board->id }}-6" class="radio-button color" id="gradient-purple"></label>
                        </div>
                        <button class="submit-btn">Submit</button>
                    </form>
                </div>
            </div>
            @endforeach
            <div class="content-board add-board" onclick="openAddboard()">
                <p><i class="fa-solid fa-plus"></i> Add New Board</p>
              </div>  
            </div>
        {{-- </div> --}}
        <div id="addboardModal" class="modal">
            <div class="modal-content">
                <div class="modal-title-close">
                    <h3>Add New Board</h3>
                    <span class="close" onclick="closeAddboard()">&times;</span>
                </div>
                <form action="/create-board" method="POST">
                    @csrf
                    <input type="hidden" name="workspace_id" value="{{ $workspace->id }}">
                    <label for="title">Board Title</label>
                    <input type="text" name="title" id="title" placeholder="Example: Figma, Laravel, etc...">
                    <label for="visibility">Board Visibility</label>
                    <select name="visibility" id="visibility">
                        <option value="allmembers">Visible to all members</option>
                        <option value="private">Private</option>
                    </select>
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
      </div>
      @include('components.btn-copy')
    <script>
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
    {{-- <div class="dashboard-wrapper">
    <div class="dashboard-boards">
        @foreach ($boards as $board)
        <div class="board-card todo-board">
            <a href="/board-task/{{ $board->id }}" class="boards">
                <h5>{{ $board['title'] }}</h5>
                <div class="boards-actions">
                    <a href="/edit-board/{{ $board->id }}">Edit</a>
                    <form action="/delete-board/{{ $board->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                    </form>
                </div>
            </a>
        </div>
        @endforeach
        <div class="board-card add-board">
            <button class="boards add-boards" onclick="openAddboard()">
                <i class="fa-solid fa-plus"></i>
                <p class="p-bold">Add New Board</p>
            </button>
        </div>
    </div>
</div>
<div id="addboardModal" class="modal">
    <div class="modal-content">
        <div class="modal-title-close">
            <h2>Add New Board</h2>
            <span class="close" onclick="closeAddboard()">&times;</span>
        </div>
        <form action="/create-board" method="POST">
            @csrf
            <input type="text" name="title">
            <div class="modal-footer">
                <button class="cancel-btn" onclick="cancelAddboard()">Cancel</button>
                <button class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
</div> --}}
</x-app-layout>