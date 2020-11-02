<?php
    // session_start();

    //For error viewing
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once('php/classes/userClass.php');
    include_once('views/header.php');
    if(!$user->is_admin()){
        header("Location: /index.php");
        die();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bestel Hier Bier</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/style_mobile.css">
    </head>
    <body>
        <div class="mobileLogo">
            <img src="images/tempLogo.png" alt="Temp Logo"/>
        </div>
        <br>
        Admin page. <br>
        Work in progress.
    </body>
</html>
