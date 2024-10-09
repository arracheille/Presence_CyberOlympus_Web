<x-app-layout>
    <div class="member">
        {{-- <div class="workspace-title">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($workspace->title) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
            <div class="workspace-title-author">
                <h4>{{ $workspace->title }}</h4>
                <p>Created by: <span>{{ $workspace->user->name }}</span></p>
                @if(!is_null($workspace->description) && $workspace->description !== '')
                <p>{{ $workspace->description }}</p>
                @endif
                <p class="text-small">{{ $workspace->type }}</p>
            </div>
            
        </div> --}}
        <div class="workspace-title">
            <div class="member-title">
                <h2>Workspace Members</h2>
                <p>From workspace <strong>{{ $workspace->title }}</strong></p>
            </div>
            <div class="task-share">
                <div class="dropdown">
                    <button class="link gradient-h-blue">Share Workspace</button>
                    <div class="dropdown-menu ">
                        <div class="dropdown-title-close">
                            <h4>Share Workspace</h4>
                            <span class="close">&times;</span>
                        </div>
                        <div class="result-container">
                            <input type="text" value="{{ $workspace->unique_code }}" class="filter" id="share_url" placeholder="Filter Posts" readonly>
                            <button class="btn ctoCb" id="clipboard">
                              <i class="far fa-clipboard"></i>
                            </button>
                        </div>
                        <p>Or invite user from email</p>
                        <form action="/send-w-code" method="POST">
                            @csrf
                            <input type="hidden" name="unique_code" value="{{ $workspace->unique_code }}">
                            <input type="email" class="input-join" name="email" placeholder="Example: acwel@gmail.com" required>
                            <button type="submit">Send Invitation</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="member-container">
            @foreach ($workspaces as $workspace)
                @foreach ($workspace->members as $member)
                    @if (auth()->user()->id === $workspace->user_id)
                    <a href="{{ url('/workspace' . '/' . $workspace->id . '/member-details' . '/' . $member->id) }}">
                        <div class="workspace-title">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($member->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
                            <input type="hidden" value="{{ $member->user->id }}">
                            @if ($member->user_id === $workspace->user_id)
                            <p>{{ $member->user->name }} <span>(Admin)</span></p>
                            @else
                            <p>{{ $member->user->name }}</p>
                            @endif
                        </div>
                    </a>
                    @else
                    <div class="workspace-title">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
                        <input type="hidden" value="{{ $member->user->id }}">
                        @if ($member->user_id === $workspace->user_id)
                        <p>{{ $member->user->name }} <span>(Admin)</span></p>
                        @else
                        <p>{{ $member->user->name }}</p>
                        @endif
                    </div>
                    @endif
                @endforeach
            @endforeach
        </div>
      </div>
      @include('components.dropdownform')
      @include('components.btn-copy')
</x-app-layout>