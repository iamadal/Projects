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
        </div>
        </div>
        <div class="main">
             <br>
             <h2>Sign in (Canteen)</h2>
             <form method="POST" action="/login">
              <div class="login-form-wrap">
                  <input type="text"     placeholder="Username" name="login_user">
                  <input type="password" placeholder="Password" name="login_user_password">
                  <p>No Account? <a href="/create">Create One!</a></p>
                  <input type="submit" value="Login" class="button">
              </div>
          </form>
        </div>
        <br>
        <hr>
        <br>
        <div> <p>Quick Links</p>
            <ol start="01" >
                <li><a href="/menu"> <img src="{{ asset('ico/Links.svg') }}" width="12px"> Food MENU </a></li>
                <li><a href="/menu"> <img src="{{ asset('ico/Links.svg') }}" width="12px"> About US </a></li>
            </ol>
        </div>
        <br>
        <hr>
        <p style="text-align: center; color: green;">&copy; BIAM Foundation, Dhaka 2025</p>
    </div>
    <!-- JS -->
    <script src="{{ asset('js/base.js') }}"></script>
</body>
</html>
