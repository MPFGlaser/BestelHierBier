<?php
//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


spl_autoload_register(function ($class_name) {
    include './php/' . $class_name . '.php';
});
require_once './php/mysql_credentials.php';

use Controllers\BeerController;
use Controllers\UserController;
use Core\PopulateFoundItems;
use Models\Beer;

$beerController = new BeerController();
$userController = new UserController();
$populate = new PopulateFoundItems();

include_once('views/header.php');
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <title>Bestel Hier Bier</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_mobile.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/productSearch.js" type="text/javascript"></script>
</head>

<body>
    <div class="div-container-content">
        <div class="filterMenu">
            <?php
            if (isset($_SESSION['User']) && $user->is_admin()) {
                echo '<input type="text" placeholder="Search" oninput="dynamicSearch(this.value, 1)"></input>';
            } else {
                echo '<input type="text" placeholder="Search" oninput="dynamicSearch(this.value, 0)"></input>';
            }
            ?>
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
            $categories = $beerController->getCategories();
            $breweries = $beerController->getBreweries();

            foreach ($categories as &$value) {
                if (isset($_SESSION['User']) && $user->is_admin()) {
                    echo "<input type='checkbox' id=$value name='filterCheckbox' value=$value onclick='filterByCheckbox(1)'>";
                    echo "<label for=$value>$value</label><br>";
                } else {
                    echo "<input type='checkbox' id=$value name='filterCheckbox' value=$value onclick='filterByCheckbox(0)'>";
                    echo "<label for=$value>$value</label><br>";
                }
            }

            echo "<p>Brewery</p>";

            foreach ($breweries as &$value) {
                if (isset($_SESSION['User']) && $user->is_admin()) {
                    echo "<input type='checkbox' id=$value name=filterCheckbox value=$value onclick='filterByCheckbox(1)'>";
                    echo "<label for=$value>$value</label><br>";
                } else {
                    echo "<input type='checkbox' id=$value name=filterCheckbox value=$value onclick='filterByCheckbox(0)'>";
                    echo "<label for=$value>$value</label><br>";
                }
            }
            ?>
        </div>
        <div class="foundItems">
            <?php
            echo (isset($_SESSION['User']) && $user->is_admin()) ? "<button onclick=\"window.location.href='/products/edit.php?id=0'\">ADD PRODUCT</button>" : '';
            $beers = $populate->found(false, "");

            foreach ($beers as $beer) {
                $name = $beer->getName();
                $brewery = $beer->getBrewery();
                $category = $beer->getCategory();
                $imgURL = $beer->getImageURL();
                $id = $beer->getId();
                $abv = $beer->getAbv();
            ?>
                <div class="product">
                    <div class="product-image">
                        <a href='/products/view.php?id=<?= $id ?>'><img src=/images/<?= $imgURL ?> alt=<?= $name ?> /> </a>
                    </div>
                    <div class="product-description">
                        <a href='/products/view.php?id=<?= $id ?>'>
                            <div style="clear: both">
                                <h1><?= $name ?></h1>
                                <h2>(<?= $abv ?>)</h2>
                            </div>
                        </a><br>
                        <p><?= $category ?> by <?= $brewery ?></p>
                    </div>
                    <div class="product-buttons">
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
