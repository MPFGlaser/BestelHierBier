<?php
    // session_start();

    //For error viewing
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include('php/classes/userClass.php');
    include('views/header.php');
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
        <div class="grid-container-top">
            <div class="grid-item">
                <img src="images/tempLogo.png" alt="Temp Logo"/>
            </div>
            <div class="grid-item-top">
                <p id="title">Bestel Hier Bier</p>
            </div>
            <div class="grid-item-top">
                <?php
                    if(isset($_SESSION['User'])){
                        $user = unserialize($_SESSION['User']);
                        if(!$user->is_admin()){
                            header("Location: https://bestelhierbier.nl");
                            die();
                        }
                        echo "<form class='info' method='post'><button name='reset'>Logout</button></form>";
                        echo '<p class="info">Welkom '.$user->get_name().'</p>';

                        if(isset($_POST['reset'])){
                            session_destroy();
                        }
                    }else{
                        header("Location: https://bestelhierbier.nl");
                        die();
                    }
                ?>
            </div>
        </div>
        <div class="mobileLogo">
            <img src="images/tempLogo.png" alt="Temp Logo"/>
        </div>
        <br/>

    </body>
</html>
