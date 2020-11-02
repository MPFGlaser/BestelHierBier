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
        <div class="grid-item-content">
            <div class="filterMenu">
                <input placeholder="Search"></input>
                <button>Search</button>
                </br>
                <p>Price</p>
                <input type="range" min="1" max="100" value="100" oninput="document.getElementById('priceLabel').innerHTML = '&#8364;'+this.value">
                <label id="priceLabel">&#8364;100</label>
                </br>
                <p>Score</p>
                <input type="range" min="1" max="5" value="5" oninput="document.getElementById('ratingLabel').innerHTML = this.value">
                <label id="ratingLabel">5</label>
                </br>
                <p>Category</p>
                <?php
                $categories = getCategories();
                $breweries = getBreweries();

                foreach ($categories as &$value) {
                    echo "<input type='checkbox' id=$value name=$value value=$value>";
                    echo "<label for=$value>$value</label><br>";
                }

                echo "<p>Brewery</p>";

                foreach ($breweries as &$value) {
                    echo "<input type='checkbox' id=$value name=$value value=$value>";
                    echo "<label for=$value>$value</label><br>";
                }
                ?>
            </div>
        </div>
        <div class="foundItems">
            <?php

            echo (isset($_SESSION['User']) && $user->is_admin()) ? "<button onclick=\"window.location.href='/products/edit.php?id=0'\">Add product</button>" : '';

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
                        <a href='/product.php?id=<?= $id ?>'><img src=/images/<?= $imgURL ?> alt=<?= $name ?> /> </a>
                    </div>
                    <div class="productDescription">
                        <a href='/product.php?id=<?= $id ?>'>
                            <h1><?= $name ?> (<?= $abv ?>)</h1>
                        </a><br>
                        <p><?= $category ?> by <?= $brewery ?></p>
                    </div>
                    <div class="button">
                        <button onclick="window.location.href='/products/view.php?id=<?= $id ?>'">Learn more</button>
                        <?php echo (isset($_SESSION['User']) && $user->is_admin()) ? "<button onclick=\"window.location.href='/products/edit.php?id=$id'\">Edit</button>" : '' ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
