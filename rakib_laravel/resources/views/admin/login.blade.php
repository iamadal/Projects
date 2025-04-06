<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Admin Action Center</h2>
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif
    <form action="{{ route('admin_login_submit') }}" method="POST">
        @csrf
        <input type="text" name="user" placeholder="Enter username">
        @error('user')
            <div style="color: red;" class="error-message">{{ $message }}</div>
        @enderror
        <input type="password" name="pass" placeholder="Password">
        @error('pass')
            <div style="color: red;" class="error-message">{{ $message }}</div>
        @enderror
        <button type="submit">Login</button>
    </form>
</body>
</html>
