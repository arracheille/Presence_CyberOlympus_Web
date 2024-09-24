@include('css')
<x-guest-layout>
    <div class="container register">
        <div class="register-container">
          <div class="register-content">
            <div class="register-body">
              <div class="logo">
                <span> <img src="images/logo.png" alt="landing-logo" /> </span>
                <h1>Presence</h1>
              </div>
            </div>
          </div>
          <div class="register-content">
            <div class="register-body">
              <h2>Welcome to Presence!</h2>
              <p>Register in the form below.</p>
              <form method="POST" action="{{ route('register') }}">
                @csrf
        
                <!-- Name -->
                <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Username" />
                <x-input-error :messages="$errors->get('name')" />

                <!-- Email Address -->
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email" />
                <x-input-error :messages="$errors->get('email')" />

                <!-- Password -->
                <x-text-input id="password"
                                type="password"
                                name="password"
                                required autocomplete="new-password" 
                                placeholder="Enter your password" />

                <x-input-error :messages="$errors->get('password')" />

                <!-- Confirm Password -->
                <x-text-input id="password_confirmation"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" 
                                placeholder="Confirm your password" />

                <x-input-error :messages="$errors->get('password_confirmation')"/>

                <div class="register-button-option">
                    <p>
                      Already have an account? <span><a href="{{ route('login') }}" class="gradient-text-blue">Log-in</a></span>
                    </p>
                    <x-primary-button class="gradient-h-blue">
                        {{ __('Register') }}
                    </x-primary-button>
                  </div>  
                <div>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>  
    {{-- <h1>Welcome To Presence!</h1> --}}

    {{-- <form method="POST" action="{{ route('register') }}" class="form-login-register">
        @csrf

        <!-- Name -->
        <div class="form-content">
            <x-input-label for="name">
                <i class="fa-solid fa-user"></i>
            </x-input-label>
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your username" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email Address -->
        <div class="form-content">
            <x-input-label for="email">
                <i class="fas fa-envelope"></i>
            </x-input-label>
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="form-content">
            <x-input-label for="password">
                <i class="fa-solid fa-unlock"></i>
            </x-input-label>

            <x-text-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="Enter your password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="form-content">
            <x-input-label for="password_confirmation">
                <i class="fa-solid fa-unlock-keyhole"></i>
            </x-input-label>

            <x-text-input id="password_confirmation"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="Confirm your password" />

            <x-input-error :messages="$errors->get('password_confirmation')"/>
        </div>

        <div>
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <a href="{{ route('login') }}">
        {{ __('Already registered?') }} <span> Log-in</span>
    </a> --}}

</x-guest-layout>
