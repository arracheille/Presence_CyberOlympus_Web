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