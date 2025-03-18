<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rakib BD</title>
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
    <div class="container">
        <h1>RAKIB BD</h1>
        <p> Please login </p>
        <form action="{{ route('app_login') }}" method="POST">
            @csrf
            <input type="text" placeholder="username"> <br> <br>
            <input type="text" placeholder="password">
            <input type="submit" name="Login">
        </form>
        <a href="/create">Create Account</a>
        <a href="/password_reset">Password Reset</a>
    </div>
</body>
</html>
