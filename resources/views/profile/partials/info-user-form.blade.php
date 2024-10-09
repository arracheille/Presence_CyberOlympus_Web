<section class="profile-edit">
    <h3>
        {{ __('Personal Information') }}
    </h3>

    <p>
        {{ __("This is an optional information, you can type your personal info if you want to.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        {{-- <x-input-label for="full_name">{{ __("Your Full Name") }}</x-input-label>
        <x-text-input id="full_name" name="full_name" type="text" class="mt-1 block w-full" :value="old('full_name', $user->full_name)" required autofocus autocomplete="name" />
        <x-input-error class="mt-2" :messages="$errors->get('full_name')" />
                
        <x-input-label for="address">{{ __("Your Email") }}</x-input-label>
        <x-text-input id="address" name="address" type="address" class="mt-1 block w-full" :value="old('address', $user->address)" required autocomplete="username" />
        <x-input-error class="mt-2" :messages="$errors->get('address')" />

        <x-input-label for="phone_number">{{ __("Your Phone Number") }}</x-input-label>
        <x-text-input id="phone_number" name="phone_number" type="phone_number" class="mt-1 block w-full" :value="old('phone_number', $user->phone_number)" required autocomplete="username" />
        <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />  --}}
        <label for="birth_date">Your Birth Date</label>
        <input type="date" name="birth_date" id="birth_date">
        
        <label for="gender">Your Gender</label>
        <select name="gender" id="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>

        <label for="created_at">Joined At</label>
        <input type="text" name="created_at" id="created_at" value="{{ $user->created_at }}" readonly>

        <div class="login-remember-me">
            <div>
                <label for="show_data" class="checkbox-item-input">
                    {{ __('Show your personal data to workspace admin') }}
                    <input type="checkbox" name="show_data" id="show_data" />
                    <span class="check login"></span>
                </label>    
            </div>    
        </div>    

        <x-primary-button>{{ __('Save') }}</x-primary-button>

        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
            >{{ __('Saved.') }}</p>
        @endif
    </form>
</section>
