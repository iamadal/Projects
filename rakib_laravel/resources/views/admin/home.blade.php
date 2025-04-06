<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Admin</title>
</head>
<body>
    <h1>Welcome Admin Panel</h1>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <a href="{{route('app_logout')}}">Logout</a>
</body>
</html>
