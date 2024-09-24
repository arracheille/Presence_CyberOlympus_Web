@include('css')
<x-guest-layout>
    <div class="container login">
        <div class="login-container">
          <div class="login-content">
            <div class="login-body">
              <form method="POST" action="{{ route('password.confirm') }}" class="form-login-register login">
                @csrf
        
                <div class="text-guest">
                    <h2>Confirm Password</h2>
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>    
        
                <!-- Password -->
                <div class="form-content">
                    <x-input-label for="password">
                        <i class="fa-solid fa-unlock"></i>
                    </x-input-label>
        
        
                    <x-text-input id="password"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
        
                    <x-input-error :messages="$errors->get('password')" />
                </div>
        
                <div>
                    <x-primary-button>
                        {{ __('Confirm') }}
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
    <form method="POST" action="{{ route('password.confirm') }}" class="form-login-register login">
        @csrf

        <div class="text-guest">
            <h1>Confirm Password</h1>
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>    

        <!-- Password -->
        <div class="form-content">
            <x-input-label for="password">
                <i class="fa-solid fa-unlock"></i>
            </x-input-label>


            <x-text-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
