<x-app-layout>
    <div class="workspace-settings">
        <div class="settings-title">            
            <h2>Workspace Settings</h2>
            <p>From workspace <strong>{{ $workspace->title }}</strong></p>
        </div>
    </div>
    @if (Auth::user()->id === $workspace->user_id)

        <form action="/workspace-leave/{{ $member->id }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="gradient-h-red" type="submit">Delete Workspace</button>
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
    <button class="gradient-h-green">View Archieved Data</button>
</x-app-layout>