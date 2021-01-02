<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/error_viewing.php';
include_once($_SERVER['DOCUMENT_ROOT'].'/php/Views/header.php');

use Controllers\UserController;

$userController = new UserController();
?>
<!DOCTYPE html>
<html lang="nl">
<script src="/js/RegisterMode.js"></script>
<script src="/js/formValidation.js"></script>

<head>
    <meta charset="utf-8">
    <title>Login/Register</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_mobile.css">
    <link rel="stylesheet" type="text/css" href="css/loginregister.css">
</head>

<body>
    <?php
    if (!isset($_SESSION['User'])) {
    ?>
        <div class="loginForm">
            <div class="loginContent">
                <h1>User login</h1>
                <div class="loginFormRegisterToggle">
                    New user?
                    <label class="switch">
                        <input type="checkbox" id="registerCheckbox" onclick="registerMode()">
                        <span class="slider round"></span>
                    </label> </div>
                <form method="POST" name="loginForm" id="loginForm" onsubmit="return validateLogin()">
                    <input type="text" required name="userName" placeholder="Username" />
                    <input type="password" required name="passWord" placeholder="Password" />
                    <button type="submit" name="submitLogin" id="loginButton">Login</button>
                </form>
                <form method="POST" name="registerForm" id="registerForm" onsubmit="return validateRegister()">
                    <input type="text" required name="userName" placeholder="Username" />
                    <input type="text" required name="email" placeholder="Email Address" id="emailField" /></p>
                    <input type="password" onkeyup="trigger()" required name="passWord" placeholder="Password" id="password"/>
                    <input type="password" required name="passWordConfirm" placeholder="Confirm Password" />
                    <div class="indicator">
                        <span class="weak"></span>
                        <span class="medium"></span>
                        <span class="strong"></span>
                    </div>
                    <div class="text"></div><br>
                    <button type="submit" name="submitRegister" id="registerButton">Register</button>
                </form>
                <script>
                    registerMode()
                </script>
            </div>
        </div>
    <?php
    } else {
        echo "You can edit your stuff here";
    }

    ?>

    <?php
    if (isset($_POST['submitLogin'])) {
        if ($userController->checkPassword($_POST['userName'], $_POST['passWord'])) {
            header("Location: /index.php");
            die();
        } else {
            echo "Something went wrong while logging in. <br>";
            echo "Are you sure you're using the correct username and password?";
        }
    }
    if (isset($_POST['submitRegister'])) {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "The email adress you provided is invalid";
        } else if ($_POST['userName'] == "") {
            echo "Please enter a valid username";
        } else if ($_POST['passWord'] == "" || $_POST['passWord'] != $_POST['passWordConfirm']) {
            echo "Please enter a valid password and check if it matches the confirmation password";
        } else {
            if ($userController->create($_POST['userName'], $_POST['passWord'], $_POST['email'])) {
                header("Location: /index.php");
                die();
            } else {
                echo "Something went wrong while registering. <br>";
                echo "If this problem persists, please contact the owner of the website.";
            }
        }
    }
    ?>
    <script src="/js/passwordStrength.js"></script>
</body>

</html>
