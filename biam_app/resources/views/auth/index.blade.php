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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @stack('styles') <!-- Additional styles -->
    <script> 
        document.documentElement.className = document.documentElement.className.replace(/\bno-js\b/, 'js'); 
    </script>
</head>
<body class="containerWrap">
    <div class="super_container">
        <div class="container bnFont box">
        <div class="header-wrap box" style="background-image: url('{{ asset('img/p.png') }}'); ">
            <div class="header">
                <div class="base-logo">
                    <img src="{{ asset('img/govt.png')}}" width="40px">
                </div>
                <p class="headerTitle">বিয়াম ফাউন্ডেশন, ঢাকা</p>
                <p class="hFooter">৬৩, নিউ ইস্কাটন, ঢাকা-১২১৭</p>
            </div>
        </div>
            <marquee scrollAmount="3"><strong>নোটিশ:</strong> অনুগ্রহ করে সকালের খাবার সকাল আটটার আগে আতিল বা অর্ডার করুন। ধন্যবাদ </marquee>
        <div class="main">
            <br>
            <h2 align="center"><i class="material-icons" style="font-size: 25px; vertical-align: middle;">lock </i> আপনার একাউন্টে লগইন করুন!</h2>
            @if ($errors->any())
                        <div class="error-list mulish-regular">
                            <ul> 
                                @foreach ($errors->all() as $error)
                                    <li class="bnFont"> <i class="material-icons" style="font-size: 25px; vertical-align: middle;">warning </i> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <form method="POST" action="{{ route('SubmitForm') }}">
                @csrf
                <div class="login-form-wrap bnFont">
                    <label><p><i class="material-icons" style="font-size:16px; vertical-align: middle;">face </i> ইউজার আইডি </p></label>
                    <input class="bnFont" type="text" placeholder="আপনার ইউজার আইডি লিখুন(ইংরেজি বর্ণে)" name="username">
                    <label> <p><i class="material-icons" style="font-size: 16px; vertical-align: middle;">lock </i> পাসওয়ার্ড </p></label>
                    <input type="password" class="bnFont" placeholder="আপনার পাসওয়ার্ডটি লিখুন (ইংরেজি বর্ণে)" name="password">
                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">লগইন মনে রাখুন</label> 
                    </div>
                    <br>
                     <p> <span style="color:red">একাউন্ট নেই?</span> <a href="{{ route('dashboard')}}">একাউন্ট তৈরী করুন!</a></p>
                   <div class="right-btn"> <button class="button bnFont" type="submit">লগইন করুন <i class="material-icons" style="font-size: 16px; vertical-align: middle;">login</i></button>  </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <script src="{{ asset('js/base.js') }}"></script>
</body>
</html>
