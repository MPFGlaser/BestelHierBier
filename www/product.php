<?php
session_start();

//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('php/classes/userClass.php');
include('php/opendb.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- <title>Bestel Hier Bier</title> -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_mobile.css">
</head>

<body>
    <div class="grid-container-top">
        <div class="grid-item">
            <img src="images/tempLogo.png" alt="Temp Logo" />
        </div>
        <div class="grid-item-top">
            <p id="title">Bestel Hier Bier</p>
        </div>
        <div class="grid-item-top">
            <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                echo "<form class='info' method='post'><button name='reset'>Logout</button></form>";
                echo '<p class="info">Welkom ' . $_SESSION["UserName"] . '</p>';

                if (isset($_POST['reset'])) {
                    session_destroy();
                }
            } else {
                echo '<a href="/login.php" class="loginBtn">Login/Register</a>';
            }
            ?>
        </div>
    </div>
    <div class="mobileLogo">
        <img src="images/tempLogo.png" alt="Temp Logo" />
    </div>
    <br />
    <div>
        <?php
        try {
            $id = $_GET['id'];
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM beers WHERE id = '" . $id . "'";
            $sqlSent = $db->prepare($sql);
            $sqlSent->execute();
            $beer = $sqlSent->fetch(PDO::FETCH_ASSOC);

            if (isset($beer['id'])) {
                // echo $beer['name'];
                $name = $beer['name'];
                $brewery = $beer['brewery'];
                $category = $beer['category'];
                $price = $beer['price'];
                $abv = $beer['abv'];
                $description = $beer['description'];
                $country = $beer['country'];
                $imgURL = $beer['imageURL'];

        ?>
                <div>
                    <title><?= $name ?> by <?= $brewery ?> - Bestel Hier Bier</title>
                    <h1><?= $name ?> - <?=$category?> (<?=$abv?>)</h1>
                    <p><?=$brewery?>, <?=$country?></p>
                    <div class="productImage">
                        <img src=/images/<?= $imgURL ?> alt=<?= $name ?> />
                    </div>
                    <div>
                        <h2>Description</h2>
                        <p><?= $description ?></p>
                    </div>
                </div>
        <?php
            } else {
                echo "No beer found! Such a shame...";
            }
        } catch (PDOException $ex) {
            die("Error: " . $ex->getMessage());
        }

        ?>
    </div>
</body>

</html>