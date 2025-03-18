<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rakib BD</title>
    <link rel="stylesheet" href="css/app.css">
    <body>
        <p>Password Reset Request</p>
        <form action="{{users.password_reset}}" method="POST">
            <input type="email" placeholder="enter your email."> <br>
            <input type="text" placeholder="enter your phone number"> <br>
            <input type="text" placeholder="enter your message to admin">
            <p>Ticket ID: </p>
            <input type="submit">
        </form>
    </body>
</html>
