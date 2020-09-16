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
        <form method="POST" name="loginForm">
            <p>Username: <input type="text" name="userName"/></p>
            <p>Password: <input type="password" name="passWord"/></p>
            <button type="submit" name="submitLogin">Submit</button>
        </form>

        <?php
            function login(){
                include('./opendb.php');
                try{
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT ID FROM Users WHERE UserName = '".$_POST["userName"]."' AND PassWord = '".md5($_POST["passWord"])."'";
                    $sqlSent = $db->prepare($sql);
                    $sqlSent->execute();
                    $results = $sqlSent->fetch(PDO::FETCH_ASSOC);
                    // foreach($results as $res){
                        // echo $res;
                        // echo var_dump($results);
                    // }
                    $ID = $results['ID'];
                    echo "User ID = ".$ID."";
                }
                catch(PDOException $ex) {
                    die("Error: ". $ex->getMessage());
                }
            }
            if(isset($_POST['submitLogin'])){
                login();
            }
        ?>
    </body>
</html>
