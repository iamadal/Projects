<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEMS 2025</title>
    <link rel="stylesheet" href="css/app.css" />
</head>
<body>

    <div class="login-container bn box">
    <div class="login-header"><p class="bn" style="text-align: center;"> &#8862; বিয়াম কর্মকর্তা/কর্মচারী বাতায়ন</p></div>
    <h4 class="bn" style="text-align: center; margin-bottom: 1.5rem; color: purple;"> লগইন করুন</h4>

    @if(session('error'))
        <p class="error-message bn" style="color: red; text-align: center;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('app_login') }}" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
        @csrf

        <div>
            <input class="bn" type="text" name="email" placeholder="ইউজার আইডি অথবা ইমেইল" value="{{ old('email') }}" style="padding: 10px">
            @error('email')
                <div class="error-message bn" style="color: red; font-size: 0.875rem; margin-top: 0.25rem;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <input class="bn" type="password" name="password" placeholder="পাসওয়ার্ড" style="padding: 10px">
            @error('password')
                <div class="error-message bn" style="color: red; font-size: 0.875rem; margin-top: 0.25rem;">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button class="bn" type="submit"
                style="padding: 0.75rem; background-color: #007bff; color: white; border: none; border-radius: 4px; font-size: 1rem; cursor: pointer;">
            লগইন করুন
        </button>
        <a href="{{route('app_root')}}" class="bn" style="text-align: center; text-decoration: none;"> &#8612; মুল পাতা</a>
    </form>
</div>
</body>
</html>


