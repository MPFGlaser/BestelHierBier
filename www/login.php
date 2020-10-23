<?php
// session_start();

//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('views/header.php');
include_once('php/register.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Login/Register</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/style_mobile.css">
    </head>
    <body>
        <div class="mobileLogo">
            <img src="../images/tempLogo.png" alt="Temp Logo"/>
        </div>
        <br/>
        <?php
        if(!isset($_SESSION['User'])){
            echo '<div class="div-container-content">
                <div class="loginContent">
                    <form method="POST" name="loginForm">
                        <p>Username: <input type="text" name="userName"/></p>
                        <p>Password: <input type="password" name="passWord"/></p>
                        <button type="submit" name="submitLogin">Login</button>
                    </form>
                </div>
                <div class="loginContent">
                    <form method="POST" name="registerForm">
                        <p>Username: <input type="text" name="userName"/></p>
                        <p>Password: <input type="password" name="passWord"/></p>
                        <p>Email: <input type="text" name="email"/></p>
                        <button type="submit" name="submitRegister">Register</button>
                    </form>
                </div>
            </div>';
        }else{
            echo "You can edit your stuff here";
        }

        ?>

        <?php
            if(isset($_POST['submitLogin'])){
                if(loginUser($_POST['userName'], $_POST['passWord'])){
                    header("Location: https://bestelhierbier.nl");
                    die();
                }else{
                    echo "Something went wrong in login";
                }
            }
            if(isset($_POST['submitRegister'])){
                if(registerNewUser($_POST['userName'], $_POST['passWord'], $_POST['email'])){
                    header("Location: https://bestelhierbier.nl");
                    die();
                }else{
                    echo "Something went wrong in register";
                }
            }
        ?>
    </body>
</html>
