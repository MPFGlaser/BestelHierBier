<?php session_start() ?>
<div class="header">
        <div class="grid-item-top">
            <a href="/index.php"><h1 id="title">Bestel Hier Bier</h1></a>
        </div>
        <div class="header-personal">
            <?php
            $currentPage = pathinfo($_SERVER["SCRIPT_FILENAME"], PATHINFO_BASENAME);
            if (isset($_SESSION['User'])) {
                $user = unserialize($_SESSION['User']);
                echo '<a href="/profile.php"><p class="info">Welcome, ' . $user->get_name() . '</p></a>';
                echo '<a href="/profile.php"><img src=/images/user.png></img></a>';
                echo "<form class='info' method='post'><button name='reset'>Logout</button></form>";

                if (isset($_POST['reset'])) {
                    session_destroy();
                    header("Refresh:0");
                }
            } else if($currentPage != "login.php"){
                    echo "<button onclick=\"window.location.href='/login.php'\">LOGIN</button>";
                }
            ?>
        </div>
    </div>
