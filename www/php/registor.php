<?php
    session_start();
    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['lastName'] = $_POST['lastName']
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="style_mobile.css">
    </head>
    <body>
        <?php
            echo "Hello ".$_SESSION['firstName']." ".$_SESSION['lastName'];
        ?>
    </body>
</html>
