@include('css')
<x-guest-layout>
    <div class="container login">
        <div class="login-container">
          <div class="login-content">
            <div class="login-body">
                <form method="POST" action="{{ route('password.store') }}" class="form-login-register">
                    @csrf
            
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
            
                    <!-- Email Address -->
                    <div class="form-content">
                        <x-input-label for="email">
                            <i class="fas fa-envelope"></i>
                        </x-input-label>
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <!-- Password -->
                    <div class="form-content">
                        <x-input-label for="password">
                            <i class="fa-solid fa-unlock"></i>
                        </x-input-label>
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
            
                    <!-- Confirm Password -->
                    <div class="form-content">
                        <x-input-label for="password_confirmation">
                            <i class="fa-solid fa-unlock-keyhole"></i>
                        </x-input-label>
            
                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                            type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
            
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
            
                    <div>
                        <x-primary-button>
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>        
        </div>
      </div>
          <div class="login-content">
            <div class="login-body">
              <div class="logo">
                <span> <img src="images/logo.png" alt="landing-logo" /> </span>
                <h1>Presence</h1>
              </div>
            </div>
          </div>
        </div>
      </div>  
</x-guest-layout>

{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}" class="form-login-register">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="form-content">
            <x-input-label for="email">
                <i class="fas fa-envelope"></i>
            </x-input-label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-content">
            <x-input-label for="password">
                <i class="fa-solid fa-unlock"></i>
            </x-input-label>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-content">
            <x-input-label for="password_confirmation">
                <i class="fa-solid fa-unlock-keyhole"></i>
            </x-input-label>

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div>
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
