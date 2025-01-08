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
    <div class="container mulish-regular box">
        <div class="header-wrap" style="background-image: url('{{ asset('img/p.png') }}'); ">
          <div class="header">
            <div class="base-logo">
               <img src="{{ asset ('img/govt.png')}}" width="50px"> 
           </div>
           <p class="headerTitle"> BIAM Foundation, Dhaka </p> <p class="hFooter">63, New Eskaton, Dhaka-1217</p> <p id="clock"></p>
           <marquee scrollAmount="3"> <strong>Notice:</strong> Please place or cancel orders for breakfast before 07:00 AM, for lunch before 11:00 AM, and for dinner before 06:00 PM. Orders placed after these time will not be accepted or cancelled.</marquee>
        </div>
        </div>
        <div class="main">
             <br>
             <h2>Sign in (Canteen)</h2>
             <form method="POST" action="{{ route('SubmitForm') }}">
              @csrf
              <div class="login-form-wrap">
                  <input type="text"      placeholder="Username" name="username" required>
                  <input type="password"  placeholder="Password" name="password" required>
                  <p>No Account? <a href="{{ route('dashboard')}}">Create One!</a></p>
                  <input type="submit" value="Login" class="button">
              </div>
          </form>
        </div>
    </div>
    <!-- JS -->
    <script src="{{ asset('js/base.js') }}"></script>
</body>
</html>
