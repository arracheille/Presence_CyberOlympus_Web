@if ($taskitem->checks->isEmpty())
@else
    <h5>Checklists</h5>
    @foreach ($taskitem->checks as $check)
    <div class="modal-details-checklist">
        <div class="checklist-title-assign">
            <h4 onclick="toggleEditCheck(this)">{{ $check->title }}</h4>
            <form action="/check-edit/{{ $check->id }}" method="POST" class="row-form">
                @csrf
                @method('PUT')
                <input type="text" name="title" value="{{ $check->title }}">
                <button class="gradient-h-blue">Save</button>
            </form>
            <div class="delete-assign">
                <div class="dropdown check-edit">
                    <button class="link">
                        <i class="fa-solid fa-user-tag"></i>
                    </button>
                    <div class="dropdown-menu assign-checklist">
                        <div class="dropdown-title-close">
                            <h5>Assign Checklist To Member</h5>
                            <span class="close">&times;</span>
                        </div>
                        <form action="/assign-check-create" method="POST">
                            @csrf
                            <input type="hidden" name="check_id" value="{{ $check->id }}">
                            <select name="user_id">
                                @foreach ($workspaces as $workspace)
                                    @foreach($workspace->members as $member)
                                        <option value="{{ $member->user->id }}"> {{ $member->user->name }} </option>
                                    @endforeach
                                @endforeach
                            </select>
                            <button type="submit" class="gradient-h-blue">Save</button>
                        </form>
                    </div>
                </div>
                <div class="user-assigned">
                    @forelse ($check->assign_checks as $assign_check)
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($assign_check->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon-small" alt="Avatar">
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
        @if($check->checklists->isEmpty())
        @else
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
                <form action="/checklist-edit/{{ $checklist->id }}" class="checklist-items-content" id="checklist-item-check{{ $checklist->id }}">
                    <label class="checkbox-item-input" for="checklist{{ $checklist->id }}">
                        {{ $checklist->checklist_title }}
                        <input type="checkbox" id="checklist{{ $checklist->id }}" onchange="checklist({{ $checklist->id }}, '{{ $checklist->checklist_title }}')" name="is_checked" value="{{ $checklist->is_checked }}" {{ $checklist->is_checked == 1 ? 'checked' : '' }}/>
                        <span class="check"></span>
                    </label>
                </form>
                <form action="/checklist-title-edit/{{ $checklist->id }}" method="POST" class="row-form" id="edit-checklist-form{{ $checklist->id }}">
                    @csrf
                    @method('PUT')
                    <input type="text" name="checklist_title" value="{{ $checklist->checklist_title }}">
                    <button class="gradient-h-blue">Save</button>
                </form>
                <div class="delete-assign checklist-content-items">
                    <form action="/checklist-delete/{{ $checklist->id }}" method="POST" class="delete-check-item">
                        @csrf
                        @method('DELETE')
                        <button class="icon">&times;</button>   
                    </form>
                    <button class="checklist-button-edit gradient-h-blue" onclick="ToggleFormEditChecklist({{ $checklist->id }})">
                        <i class="fa-solid fa-pen"></i>
                    </button>
                    <div class="dropdown checklist-edit">
                        <button class="link">
                            <i class="fa-solid fa-user-tag"></i>
                        </button>
                        <div class="dropdown-menu assign-checklist">
                            <div class="dropdown-title-close">
                                <h5>Assign Checklist Item To Member</h5>
                                <span class="close">&times;</span>
                            </div>
                            <form action="/assign-checklist-create" method="POST">
                                @csrf
                                <input type="hidden" name="checklist_id" value="{{ $checklist->id }}">
                                <select name="user_id">
                                    @foreach ($workspaces as $workspace)
                                        @foreach($workspace->members as $member)
                                            <option value="{{ $member->user->id }}"> {{ $member->user->name }} </option>
                                        @endforeach
                                    @endforeach
                                </select>
                                <button type="submit" class="gradient-h-blue">Save</button>
                            </form>
                        </div>
                    </div>
                    <div class="user-assigned">
                        @forelse ($checklist->assign_checklists as $assign_checklist)
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($assign_checklist->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon-small" alt="Avatar">
                        @empty
                        @endforelse
                    </div>
                </div>
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