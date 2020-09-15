<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="style_mobile.css">
    </head>
    <body>
        <form method="POST" name="registerForm" action="registor.php">
            <p>First name: <input type="text" name="firstName"/></p>
            <p>Second name: <input type="text" name="lastName"/></p>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>
