<div class="grid-container-top">
        <div class="grid-item">
            <a href="/index.php"><img src="images/tempLogo.png" alt="Temp Logo" /></a>
        </div>
        <div class="grid-item-top">
            <p id="title">Bestel Hier Bier</p>
        </div>
        <div class="grid-item-top">
            <?php
            $currentPage = pathinfo($_SERVER["SCRIPT_FILENAME"], PATHINFO_BASENAME);
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                echo "<form class='info' method='post'><button name='reset'>Logout</button></form>";
                echo '<p class="info">Welkom ' . $_SESSION["UserName"] . '</p>';


                if (isset($_POST['reset'])) {
                    session_destroy();
                }
            } else if($currentPage != "login.php"){
                    echo '<a href="/login.php" class="loginBtn">Login/Register</a>';
                }
            
            ?>
        </div>
    </div>