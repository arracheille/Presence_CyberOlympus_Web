@include('css')
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <div class="container login">
        <div class="login-container">
          <div class="login-content">
            <div class="login-body">
                <form method="POST" action="{{ route('password.email') }}" class="form-login-register login">
                    @csrf
            
                    <div class="text-guest">
                        <h2>Forgot Password</h2>
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>    
            
                    <!-- Email Address -->
                    <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="Enter your email" required autofocus />
                    <x-input-error :messages="$errors->get('email')" />
            
                    <div>
                        <x-primary-button class="gradient-h-blue">
                            {{ __('Email Password Reset Link') }}
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
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="form-login-register login">
        @csrf

        <div class="text-guest">
            <h1>Forgot Password</h1>
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>    

        <!-- Email Address -->
        <div class="form-content">
            <x-input-label for="email">
                <i class="fas fa-envelope"></i>
            </x-input-label>
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
