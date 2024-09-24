<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/x-icon">

        <title>Presence</title>

        @include('components.css')

        <!-- Scripts -->
        @vite(['resources/js/app.js'])
    </head>
    <body>
        {{ $slot }}
    </body>
</html>