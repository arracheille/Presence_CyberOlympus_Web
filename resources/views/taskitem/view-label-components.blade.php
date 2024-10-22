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
    $taskitem->due_dates->whereNotNull('task_item_id')->where('task_item_id', '!=', '')->first() ||
    $taskitem->taskitem_members->whereNotNull('task_item_id')->where('task_item_id', '!=', '')->first() ||
    $taskitem->attachments->whereNotNull('link')->where('link', '!=', '')->first() ||
    $taskitem->attachments->whereNotNull('link_display')->where('link_display', '!=', '')->first() ||
    $taskitem->attachments->whereNotNull('image')->where('image', '!=', '')->first())
    <div class="container-task-component">

        @if(!is_null($taskitem->description) && $taskitem->description !== '')
            <div class="content-task-component" id="item-description">
                <i class="fa-solid fa-align-left"></i>
            </div>
        @endif

        @if($taskitem->checks->whereNotNull('title')->where('title', '!=', '')->first())
            <div class="content-task-component" id="item-checklist">
                <span><i class="fa-solid fa-square-check"></i> {{ $taskitem->checks->count() }}</span>
            </div>
        @endif

        @if($taskitem->comments->whereNotNull('comment')->where('comment', '!=', '')->first())
            <div class="content-task-component" id="item-comment">
                <span><i class="fa-solid fa-comments"></i> {{ $taskitem->comments->count() }}</span>
            </div>
        @endif

        @php
            $attachmentCount = $taskitem->attachments->filter(function($attachment) {
                return !empty($attachment->image) || !empty($attachment->link) || !empty($attachment->link_display);
            })->count();
        @endphp

        @if($taskitem->attachments->whereNotNull('image')->where('image', '!=', '')->first() || 
            $taskitem->attachments->whereNotNull('link')->where('link', '!=', '')->first() ||
            $taskitem->attachments->whereNotNull('link_display')->where('link_display', '!=', '')->first())
            <div class="content-task-component" id="item-attachment">
                <span><i class="fa-solid fa-paperclip"></i> {{ $attachmentCount }}</span>
            </div>
        @endif

        @if($taskitem->due_dates->whereNotNull('task_item_id')->where('task_item_id', '!=', '')->first())
            <div class="content-task-component" id="item-due-date">
                @if (\Carbon\Carbon::parse($taskitem->due_dates->first()->due_at)->lt(\Carbon\Carbon::now()))
                <span class="gradient-text-red"><i class="fa-solid fa-clock"></i> !</span>
                @else
                <i class="fa-solid fa-clock"></i>
                @endif
            </div>
        @endif
    </div>

    <div class="container-assign-component">
        <div class="taskitem-member-container">
            @if($taskitem->assigns->whereNotNull('task_item_id')->where('task_item_id', '!=', '')->first())
                @foreach ($taskitem->assigns as $assign)
                    <div class="taskitem-member-content">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($assign->user) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon-smaller" alt="Avatar">
                        <span><i class="fa-solid fa-at"></i></span>
                    </div>
                @endforeach
            @endif
            @if($taskitem->taskitem_members->whereNotNull('user_id')->where('user_id', '!=', '')->first())
                @foreach ($taskitem->taskitem_members as $taskitem_member)
                    <div class="taskitem-member-content">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($taskitem_member->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon-smaller" alt="Avatar">
                        <span><i class="fa-solid fa-address-book"></i></span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endif