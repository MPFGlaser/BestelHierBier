<?php
// session_start();

//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('php/classes/userClass.php');
include('views/header.php');
include_once('php/product.php')

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
        <div class="filterBar">
            <div class="filterMenu">
                <input type=text placeholder="Start searching..."></input>
                <button>SEARCH</button>
                </br>
                <p>Price</p>
                <input type="range" min="1" max="100" value="100">
                </br>
                <p>Score</p>
                <input type="range" min="1" max="5" value="5">
                </br>
                <p>Category</p>
                <?php
                $categories = getCategories();
                foreach ($categories as &$value) {
                ?>
                    <input type="checkbox" id=<?= $value ?> name=<?= $value ?> value=<?= $value ?>>
                    <label for=<?= $value ?>><?= $value ?></label><br>
                <?php
                }
                ?>
                <p>Brewery</p>
                <?php
                $breweries = getBreweries();
                foreach ($breweries as &$value) {
                ?>
                    <input type="checkbox" id=<?= $value ?> name=<?= $value ?> value=<?= $value ?>>
                    <label for=<?= $value ?>><?= $value ?></label><br>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="foundItems">
            <?php

            echo (isset($_SESSION['User']) && $user->is_admin()) ? "<button onclick=\"window.location.href='/products/edit.php?id=0'\">ADD PRODUCT</button>" : '';

            $beers = getAllProducts();

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
                        <a href='/products/view.php?id=<?= $id ?>'><img src=/images/<?= $imgURL ?> alt=<?= $name ?> /> </a>
                    </div>
                    <div class="productDescription">
                        <a href='/products/view.php?id=<?= $id ?>'>
                            <div style="clear: both">
                                <h1><?= $name ?></h1>
                                <h2>(<?= $abv ?>)</h2>
                            </div>
                        </a><br>
                        <p><?= $category ?> by <?= $brewery ?></p>
                    </div>
                    <div>
                        <button onclick="window.location.href='/products/view.php?id=<?= $id ?>'">LEARN MORE</button>
                        <?php echo (isset($_SESSION['User']) && $user->is_admin()) ? "<button onclick=\"window.location.href='/products/edit.php?id=$id'\">EDIT</button>" : '' ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>