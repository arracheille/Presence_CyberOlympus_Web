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
                <div class="text-guest">
                    <h2>Verify Email</h2>
                    <p>{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
                    
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                        </div>
                    @endif
                </div>
                <div class="verify-guest">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
            
                        <div>
                            <x-primary-button>
                                {{ __('Resend Verification Email') }}
                            </x-primary-button>
                        </div>
                    </form>
            
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
            
                        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>  
</x-guest-layout>
{{-- <x-guest-layout>
    <div class="text-guest">
        <h1>Verify Email</h1>
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif
    </div>
    <div class="verify-guest">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>    
</x-guest-layout> --}}
