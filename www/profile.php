<?php
//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('php/classes/userClass.php');
include('php/opendb.php');
include_once('views/header.php');

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
    <?php
        if(isset($_SESSION['User'])){
            $user = unserialize($_SESSION['User']);
        }else{
            header("Location: https://bestelhierbier.nl/login.php");
            die();
        }
    ?>
    <div class="profile">
    <?php
        echo "<form method='post'>";
            echo "<label>Change username: <input type='text' name='username' value=".$user->get_name()."></label>";
            echo "<label>Change email: <input type='text' name='email' value=".$user->get_email()."></label>";
            echo "<label>Change password: <input type='password' name='paswordNew'></label>";
            echo "<label>Confirm password: <input type='password' name='passwordConfirm'></label>";
            echo "<div><button type='submit' name='saveNewInformation'>Save</button></div>";
        echo "</form>";

        if(isset($_POST['saveNewInformation'])){
            echo "TEST";
        }
    ?>
    </div>
</body>

</html>
