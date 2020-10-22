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
    <title>Bestel Hier Bier</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_mobile.css">
</head>

<body>
    <div class="mobileLogo">
        <img src="images/tempLogo.png" alt="Temp Logo" />
    </div>
    <br />
    <div class="div-container-content">
        <div class="grid-item-content">
            <div class="filterMenu">
                <input placeholder="Search"></input>
                <button>Search</button>
                </br>
                <p>Price</p>
                <input type="range" min="1" max="100" value="50">
                </br>
                <p>Score</p>
                <input type="range" min="1" max="5" value="3">
                </br>
                <p>Category</p>
                <?php
                try {
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT DISTINCT category FROM beers";
                    $sqlSent = $db->prepare($sql);
                    $sqlSent->execute();
                    $categories = $sqlSent->fetchAll(PDO::FETCH_COLUMN);
                    sort($categories);

                    foreach ($categories as &$value) {
                ?>
                        <input type="checkbox" id=<?= $value ?> name=<?= $value ?> value=<?= $value ?>>
                        <label for=<?= $value ?>><?= $value ?></label><br>
                <?php
                    }
                } catch (PDOException $ex) {
                    die("Error: " . $ex->getMessage());
                }
                ?>
                <p>Brewery</p>
                <?php
                try {
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT DISTINCT brewery FROM beers";
                    $sqlSent = $db->prepare($sql);
                    $sqlSent->execute();
                    $breweries = $sqlSent->fetchAll(PDO::FETCH_COLUMN);
                    sort($breweries);

                    foreach ($breweries as &$value) {
                ?>
                        <input type="checkbox" id=<?= $value ?> name=<?= $value ?> value=<?= $value ?>>
                        <label for=<?= $value ?>><?= $value ?></label><br>
                <?php
                    }
                } catch (PDOException $ex) {
                    die("Error: " . $ex->getMessage());
                }
                ?>
            </div>
        </div>
        <div class="foundItems">
            <?php
            try {
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM beers";
                $sqlSent = $db->prepare($sql);
                $sqlSent->execute();
                $beers = $sqlSent->fetchAll(PDO::FETCH_ASSOC);

                foreach ($beers as $row) {
                    $name = $row["name"];
                    $brewery = $row["brewery"];
                    $category = $row["category"];
                    $imgURL = $row["imageURL"];
                    $id = $row["id"];
                    $abv = $row["abv"];

            ?>
                    <div class="product">
                        <div class="productImage">
                            <a href='/product.php?id=<?= $id ?>'><img src=/images/<?= $imgURL ?> alt=<?= $name ?> /> </a>
                        </div>
                        <div class="productDescription">
                            <a href='/product.php?id=<?= $id ?>'><h1><?= $name ?> (<?= $abv ?>)</h1></a><br>
                            <!-- <h1><?= $name ?> (<?= $abv ?>)</h1><br> -->
                            <p><?= $category ?> by <?= $brewery ?></p>
                        </div>
                        <div class="button">
                            <button onclick="window.location.href='/product.php?id=<?= $id ?>'">Learn more</button>
                        </div>
                    </div>
            <?php
                }
            } catch (PDOException $ex) {
                die("Error: " . $ex->getMessage());
            }
            ?>
        </div>
    </div>
</body>

</html>