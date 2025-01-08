<!-- Copyright Adal Khan, <mdadalkhan@gmail.com> 6 JAN 2025 -->

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
    <div class="dashboard">
        <h1>Dashboard</h1>
    </div>
    <script src="{{ asset('js/base.js') }}"></script>
</body>
</html>
