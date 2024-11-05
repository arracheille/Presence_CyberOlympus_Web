<x-app-layout>
    <div class="workspace-settings">
        <div class="settings-title">            
            <h2>Workspace Settings</h2>
            <p>From workspace <strong>{{ $workspace->title }}</strong></p>
        </div>
    </div>
    @if (Auth::user()->id === $workspace->user_id)

        <form action="/delete-workspace/{{ $workspace->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="gradient-h-red" type="submit">Archive Workspace</button>
        </form>

        <form action="/workspace-leave/{{ $member->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="gradient-h-orange" type="submit">Leave Workspace</button>
        </form>

    @else

        <form action="/workspace-leave/{{ $member->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="gradient-h-red" type="submit">Leave Workspace</button>
        </form>

    @endif
</x-app-layout>