@include('css')
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status :status="session('status')" />

    <div class="container login">
        <div class="login-container">
          <div class="login-content">
            <div class="login-body">
              <h2>Welcome Back to Presence!</h2>
              <p>Lets fill this form first before we come back.</p>
              <form method="POST" action="{{ route('login') }}" class="form-login-register">
                @csrf
        
                <!-- Email Address -->
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
                <x-input-error :messages="$errors->get('email')" />
        
                <!-- Password -->
                <x-text-input id="password"
                                type="password"
                                name="password"
                                required autocomplete="current-password" 
                                placeholder="Enter your password" />
    
                <x-input-error :messages="$errors->get('password')" />
        
                <!-- Remember Me -->
                <div class="login-remember-me">
                    <div>
                        <label for="remember_me" class="checkbox-item-input">
                            {{ __('Remember me') }}
                            <input type="checkbox" name="remember" id="remember_me" />
                            <span class="check login"></span>
                        </label>
                    </div>
                    
                    <div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>


                <div class="login-button-option">
                    <p>
                      Don't have an account? <span><a href="{{ route('register') }}" class="gradient-text-blue">Register</a></span>
                    </p>
                    <x-primary-button class="gradient-h-blue">
                        {{ __('Log in') }}
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
