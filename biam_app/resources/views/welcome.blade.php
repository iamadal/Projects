<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Laravel Application')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('styles') <!-- Additional styles -->

    <!-- Scripts (for older browsers, if needed) -->
    <script>
        document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/, 'js');
    </script>
</head>
<body>
    <header>
        <!-- Navbar or header content -->
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <!-- Footer content -->
    </footer>

    <!-- JS -->
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts') <!-- Additional scripts -->
</body>
</html>
