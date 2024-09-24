<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

        <title>Presence</title>

        @include('css')

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    </head>
    <body>
        <div class="container dashboard">
          @include('layouts.sidebar')
          @include('layouts.navbar')

          <div class="dashboard-content">
            {{ $slot }}
          </div>
        </div>
        @include('components.jquery')
        @include('components.popper')
        {{-- @include('components.datatables') --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      
        <script>
          toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "extendedTimeOut": "0",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
          };
          document.addEventListener('DOMContentLoaded', () => {
            @if(session('success'))
              toastr.success('{{ session('success') }}');
            @endif
          });
        </script>
        
        <script src="{{ asset('js/modalcheck.js') }}"></script>
        <script src="{{ asset('js/time-date.js') }}"></script>
        <script src="{{ asset('js/sweetalertcheck.js') }}"></script>
    </body>
</html>
