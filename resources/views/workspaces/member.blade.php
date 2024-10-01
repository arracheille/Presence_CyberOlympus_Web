<x-app-layout>
    <div class="member">
        <div class="workspace-title">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
            <div class="workspace-title-author">
                <h4>{{ $workspace->title }}</h4>
                <p>Created by: <span>{{ $workspace->user->name }}</span></p>
                @if(!is_null($workspace->description) && $workspace->description !== '')
                <p>{{ $workspace->description }}</p>
                @endif
                <p class="text-small">{{ $workspace->type }}</p>
            </div>
            <div class="task-share">
                <div class="dropdown">
                    <button class="link gradient-h-blue">Share</button>
                    <div class="dropdown-menu ">
                        <div class="dropdown-title-close">
                            <h4>Share Links</h4>
                            <span class="close">&times;</span>
                        </div>
                        <div class="result-container">
                            <input type="text" value="{{ $workspace->unique_code }}" class="filter" id="share_url" placeholder="Filter Posts" readonly>
                            <button class="btn ctoCb" id="clipboard">
                              <i class="far fa-clipboard"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3>Workspace Members</h3>
        <div class="member-container">
            @foreach ($workspaces as $workspace)
                @foreach ($workspace->members as $member)
                    <div class="workspace-title">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
                        <input type="hidden" value="{{ $member->user->id }}">
                        @if ($member->user_id === $workspace->user_id)
                        <p>{{ $member->user->name }} <span>(Admin)</span></p>
                        @else
                        <p>{{ $member->user->name }}</p>
                        @endif
                    </div>
                @endforeach
            @endforeach
        </div>
      </div>
      @include('components.dropdownform')
      @include('components.btn-copy')
</x-app-layout>