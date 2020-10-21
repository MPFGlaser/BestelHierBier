<?php
session_start();

//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('php/classes/userClass.php');
include('php/opendb.php');
include('views/header.php');
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
                <div class="productPage">
                    <title><?= $name ?> by <?= $brewery ?> - Bestel Hier Bier</title>
                    <div class="grid-item">
                        <h1><?= $name ?> - <?= $category ?> (<?= $abv ?>)</h1>
                        <a href=/images/<?= $imgURL ?>><img src=/images/<?= $imgURL ?> alt="<?= $name ?>" />    </a>                    
                    </div>
                    <div class="productPageDescription">
                        <h4>Description</h4>
                        <p><?= $description ?></p>

                        <br>
                        <div>Brewed by <?= $brewery ?> in <?= $country ?></div>
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