<x-app-layout>
    <div class="workspace-settings">
        <div class="settings-title">            
            <h2>Workspace Settings</h2>
            <p>From workspace <strong>{{ $workspace->title }}</strong></p>
        </div>
    </div>
    @if (Auth::user()->id === $workspace->user_id)
        <button class="gradient-h-red">Delete Workspace</button>
        <button class="gradient-h-orange">Leave Workspace</button>
    @else
        <button class="gradient-h-orange">Leave Workspace</button>
    @endif
    <button class="gradient-h-green">View Archieved Data</button>
</x-app-layout>