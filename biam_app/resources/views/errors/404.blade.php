<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BIAM Automation System - BAS')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}"> @stack('styles') <!-- Additional styles -->
    <script> document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/, 'js'); </script>
</head>
<body>
    <div class="err box"><h3>Page not found! :( </h3> <p>&copy; BIAM Foundation, Dhaka</p> <a class="button" href="/"> Go Back to Home</a> </div>
</body>
</html>
