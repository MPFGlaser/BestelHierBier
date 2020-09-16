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
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="style_mobile.css">
    </head>
    <body>
        <?php
        include('./opendb.php');
        try{
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM test";
            $sqlSent = $db->prepare($sql);
            $sqlSent->execute();
            $results = $sqlSent->fetch(PDO::FETCH_ASSOC);
            foreach($results as $res){
                echo $res;
            }
        }
        catch(PDOException $ex) {
            die("Error: ". $ex->getMessage());
        }
        ?>
    </body>
</html>
