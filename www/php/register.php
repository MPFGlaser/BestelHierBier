<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/style_mobile.css">
    </head>
    <body>
        <form method="POST" name="registerForm">
            <p>Username: <input type="text" name="userName"/></p>
            <p>Password: <input type="password" name="passWord"/></p>
            <p>Email: <input type="text" name="email"/></p>
            <button type="submit" name="submitRegister">Submit</button>
        </form>

        <?php
            function register(){
                include('./opendb.php');
                try{
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "INSERT INTO Users (UserName, PassWord, EMail) VALUES ('".$_POST["userName"]."','".md5($_POST["passWord"])."','".$_POST["email"]."')";
                    $sqlSent = $db->prepare($sql);
                    $sqlSent->execute();
                }
                catch(PDOException $ex) {
                    die("Error: ". $ex->getMessage());
                }
            }
            if(isset($_POST['submitRegister'])){
                register();
            }
        ?>
    </body>
</html>
