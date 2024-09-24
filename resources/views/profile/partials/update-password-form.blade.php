<section class="profile-edit">
    <h3>
        {{ __('Update Password') }}
    </h3>

    <p>
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <x-input-label for="update_password_current_password">{{ __('Enter your old password') }}</x-input-label>
        <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" placeholder="Your old password..." />
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />

        <x-input-label for="update_password_password">{{ __('Enter your new password') }}</x-input-label>
        <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="Your new password..."/>
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />

        <x-input-label for="update_password_password_confirmation">{{ __('Confirm your old password') }}</x-input-label>
        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" placeholder="Confirm your new password..." />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
