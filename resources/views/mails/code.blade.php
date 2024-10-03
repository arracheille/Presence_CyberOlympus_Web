<title>{{ $workspace->user->name }} {{ $subject }}</title>
<h1>{{ $subject }} from {{ $workspace->user->name }} </h1>
<h4>{{ $mailMessage }}</h4>
<a href="{{ route('workspaces.join-email', ['unique_code' => $workspace->unique_code]) }}" 
    style="display: inline-block; padding: 10px 20px; color: white; background-color: #2929cc; text-decoration: none; border-radius: 5px;">
     Accept Invitation
</a>
<p>If the button didn't work, copy this code and join the workspace <strong>{{ $workspace->unique_code }}</strong></p>