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