<?php session_start(); ?>
<div class="grid-container-top">
        <div class="grid-item">
            <a href="/index.php"><img src="/images/tempLogo.png" alt="Temp Logo" /></a>
        </div>
        <div class="grid-item-top">
            <a href="/index.php"><h1 id="title">Bestel Hier Bier</h1></a>
        </div>
        <div class="grid-item-top">
            <?php
            $currentPage = pathinfo($_SERVER["SCRIPT_FILENAME"], PATHINFO_BASENAME);
            if (isset($_SESSION['User'])) {
                $user = unserialize($_SESSION['User']);
                echo "<form class='info' method='post'><button name='reset'>Logout</button></form>";
                echo '<p class="info">Welkom ' . $user->get_name() . '</p>';


                if (isset($_POST['reset'])) {
                    session_destroy();
                }
            } else if($currentPage != "login.php"){
                    echo '<a href="/login.php" class="loginBtn">Login/Register</a>';
                }
            ?>
        </div>
    </div>
