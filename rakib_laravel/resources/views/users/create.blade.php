<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rakib BD</title>
    <link rel="stylesheet" href="css/app.css">
    <style>
        .error-message {
            color: red;
            font-size: 12px;
        }
        .success-message {
            color: green;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Registration Request</h1>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="error-message">{{ session('error') }}</div>
        @endif

        <form action="{{ route('users.register') }}" method="POST">
            @csrf

            <!-- Username -->
            <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
            @error('username')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <br><br>

            <!-- Email -->
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <br><br>

            <!-- Password -->
            <input type="password" name="password" placeholder="Password">
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <br><br>

            <!-- Confirm Password -->
            <input type="password" name="password_confirmation" placeholder="Confirm Password">
            @error('password_confirmation')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <br><br>

            <!-- Phone -->
            <input type="tel" name="phone" placeholder="Phone" value="{{ old('phone') }}">
            @error('phone')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <br><br>

            <!-- Country -->
            <select name="country">
                <option value="">Select your country</option>
                <option value="Bangladesh" {{ old('country') == 'Afghanistan' ? 'selected' : '' }}>Bangladesh</option>
                <!-- Add more countries here -->
            </select>
            @error('country')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <br><br>
            <input type="text" name="fullname" value="{{ old('fullname') }}" placeholder="enter your full Name (e.g Jon Doe)"> <br><br>
             @error('fullname')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <!-- Gender -->
            <select name="gender">
                <option value="">Select your gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <br><br>

            <!-- Date of Birth -->
            <input type="date" name="dob" value="{{ old('dob') }}">
            @error('dob')
                <div class="error-message">{{ $message }}</div>
            @enderror
            <br><br>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
