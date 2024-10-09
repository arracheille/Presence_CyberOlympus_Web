<x-app-layout>
    <header>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </header>
    <div class="member">
        <h2>Workspace Member Details</h2>
        <div class="workspace-title">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($member->user->name) }}&color=FFFFFF&background=2929CC&rounded=true&bold=true" class="icon" alt="Avatar">
            <h3>{{ $member->user->name }}</h3>
        </div>
        <div class="member-details">
            <h4>{{ $member->user->email }}</h4>
            <p>Joined At: {{ $member->created_at }}</p>
            <div class="member-role">
                <p>Role:</p>
                <form action="/member-edit/{{ $member->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <select name="role" id="role">
                        <option value="admin" {{ $member->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="member" {{ $member->role == 'member' ? 'selected' : '' }}>Member</option>
                    </select>
                    <button type="submit" class="gradient-h-blue">Change</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        // document.getElementById('role').addEventListener('change', function() {
        //     var form = document.getElementById('roleupdate');
        //     var formData = new FormData(form);

        //     fetch(form.action, {
        //         method: 'POST',
        //         body: formData,
        //         url: '/update-member-role',
        //         headers: {
        //             'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        //             'X-Requested-With': 'XMLHttpRequest',
        //         },
        //     })
        //     .then(response => response.json())
        //     .then(data => {
        //         console.log('Role updated:', data);
        //     })
        //     .catch(error => {
        //         console.error('Error:', error);
        //     });
        // });
    </script>
</x-app-layout>