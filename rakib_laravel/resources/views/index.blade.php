<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    @if(session('success'))
        <p style="color: red;">{{ session('success') }}</p>
    @endif
    <h1>Welcom to RAKIB BD</h1>
    <a href="{{route('app_login_view')}}">Login</a>
</body>
</html>
