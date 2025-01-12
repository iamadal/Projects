<!-- Copyright Adal Khan, <mdadalkhan@gmail.com> 6 JAN 2025 -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'BIAM Automation System - BAS')</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}"> 
    @stack('styles') <!-- Additional styles -->
    <script> 
        document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/, 'js'); 
    </script>
</head>
<body>
    <div class="container mulish-regular box">
        <div class="header-wrap" style="background-image: url('{{ asset('img/p.png') }}'); ">
            <div class="header">
                <div class="base-logo">
                    <img src="{{ asset('img/govt.png')}}" width="50px">
                </div>
                <p class="headerTitle">BIAM Foundation, Dhaka</p>
                <p class="hFooter">63, New Eskaton, Dhaka-1217</p>
                <p id="clock"></p>
            </div>
        </div>
            <marquee scrollAmount="3"><strong>Notice:</strong> Please place or cancel orders for breakfast before 07:00 AM, for lunch before 11:00 AM, and for dinner before 06:00 PM. Orders placed after these time will not be accepted or cancelled. </marquee>
        <div class="main">
            <br>
            <h2>Sign in (Canteen)</h2>
            <form method="POST" action="{{ route('SubmitForm') }}">
                @if (session('success')) 
                        {{ session('success') }}
                @endif
                @csrf
                 @if ($errors->any())
                        <div class="error-list">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <div class="login-form-wrap">
                    <label><strong>Username</strong></label>
                    <input type="text" placeholder="Enter your username" name="username" required>
                    <label><strong>Password</strong></label>
                    <input type="password" placeholder="Enter your password" name="password" required>
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember Me</label> 
                    </div>
                    <br>
                     <p> <span style="color:red">No account?</span> <a href="{{ route('dashboard')}}">Create One!</a></p>
                   <div class="right-btn"> <input type="submit" value="Login" class="button"></div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/base.js') }}"></script>
    <script>
        function updateClock(){var now=new Date(),hours=now.getHours(),minutes=now.getMinutes(),seconds=now.getSeconds(),ampm=hours>=12?"PM":"AM";hours=hours%12;hours=hours?hours:12;hours=hours<10?"0"+hours:hours;minutes=minutes<10?"0"+minutes:minutes;seconds=seconds<10?"0"+seconds:seconds;document.getElementById("clock").innerHTML=hours+":"+minutes+":"+seconds+" "+ampm}setInterval(updateClock,1000);updateClock();
    </script>
</body>
</html>
