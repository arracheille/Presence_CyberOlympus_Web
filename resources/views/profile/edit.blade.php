<x-app-layout>
    <div class="container profile-edit">
        @include('profile.partials.update-profile-information-form')
    </div>
    <div class="container profile-edit">
        @include('profile.partials.info-user-form')
    </div>
    <div class="container profile-edit">
        @include('profile.partials.update-password-form')
    </div>
</x-app-layout>
