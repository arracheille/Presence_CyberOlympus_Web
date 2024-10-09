@if ($taskitem->attachments->isEmpty())
    
@else
<h4>Attachments</h4>
    @foreach ($taskitem->attachments as $attachment)
    @if (empty($attachment->image))
    
    @else
    <div class="attachment-edit-container">
        <div class="dropdown">
            <button class="link"><i class="fa-solid fa-ellipsis-vertical"></i></button>
            <div class="dropdown-menu dropdown-color">
                <div class="dropdown-title-close">
                <h4>Edit Attachment</h4>
                <span class="close">&times;</span>
                </div>
                <form action="/attachment-edit/{{ $attachment->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <label for="image">Only upload images with jpeg, jpg and png types!</label>
                    <input type="file" name="image" id="image" value="{{ $attachment->image }}">
                    <button type="submit" class="submit-btn">Save</button>      
                </form>
                <form action="/attachment-delete/{{ $attachment->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">Delete</button>
                </form>                        
            </div>
            </div>
        <img src="{{ asset($attachment->image) }}">
        <p class="text-small">Image: {{ basename($attachment->image) }}</p>

    </div>
    @endif
    @if (empty($attachment->link))

    @else
    <div class="attachment-link-container">
        <div class="dropdown label-edit attachment">
            <button class="link">
                <div class="attachment-link-icon">
                    <i class="fa-solid fa-link"></i>
                </div>        
            </button>
            <div class="dropdown-menu label dropdown-color">
                <div class="dropdown-title-close">
                    <h4>Edit attachment</h4>
                    <span class="close">&times;</span>
                </div>
                {{-- attachment link modal --}}
                <form action="/attachment-edit/{{ $attachment->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- <input type="text" name="link" id="link" > --}}
                    <label for="link">Uploaded Link</label>
                    <input type="text" name="link" id="link" value="{{ $attachment->link }}">
                    <label for="link">Display Text</label>
                    <input type="text" name="link_display" id="link_display" value="{{ $attachment->link_display }}">
                    <button type="submit" class="submit-btn">Save</button>      
                </form>
                <form action="/attachment-delete/{{ $attachment->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
                </div>
        </div>
        <a href="{{ $attachment->link }}" class="attachment-link"><p>{{ $attachment->link_display }}</p></a>
    </div>
    @endif
    @endforeach
@endif