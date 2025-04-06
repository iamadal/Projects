<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcom</h1>
    <p> Profile Information </p>
    <p> Name: {{ session('name') }}  </p>
    <p>Email: {{ session('email') }}</p>
    <p>Phone: {{ session('phone') }}</p>
    <a href="{{ route('app_logout')}}">logout</a>
</body>
</html>