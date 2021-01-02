<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/error_viewing.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/Views/header.php');

use Controllers\BeerController;
use Controllers\UserController;
use Core\PopulateFoundItems;
use Views\BeerCard;

$beerController = new BeerController();
$userController = new UserController();
$populate = new PopulateFoundItems();
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
                echo '<input type="text" placeholder="Search" oninput="debounce(dynamicSearch(this.value, 1), 500)"></input>';
            } else {
                echo '<input type="text" placeholder="Search" oninput="debounce(dynamicSearch(this.value, 0), 500)"></input>';
            }
            ?>
            <p>Price</p>
            <?php
            if (isset($_SESSION['User']) && $user->is_admin()){
                echo '<input type="range" min="1" max="25" value="100" oninput="debounce(filterByPrice(1), 100)" id="priceSlider">';
            }else{
                echo '<input type="range" min="1" max="25" value="100" oninput="debounce(filterByPrice(0), 100)" id="priceSlider">';
            }
             ?>

            <label id="priceLabel">&#8364;25</label>
            </br>
            <p>Category</p>
            <?php
            $categories = $beerController->getCategories();
            $breweries = $beerController->getBreweries();

            foreach ($categories as &$value) {
                if (isset($_SESSION['User']) && $user->is_admin()) {
                    echo "<input type='checkbox' id='$value' name='filterCheckbox' value='$value' onclick='filterByCheckbox(1)'>";
                    echo "<label for='$value'>$value</label><br>";
                } else {
                    echo "<input type='checkbox' id='$value' name='filterCheckbox' value='$value' onclick='filterByCheckbox(0)'>";
                    echo "<label for='$value'>$value</label><br>";
                }
            }

            echo "<p>Brewery</p>";

            foreach ($breweries as &$value) {
                if (isset($_SESSION['User']) && $user->is_admin()) {
                    echo "<input type='checkbox' id='$value' name=filterCheckbox value='$value' onclick='filterByCheckbox(1)'>";
                    echo "<label for='$value'>$value</label><br>";
                } else {
                    echo "<input type='checkbox' id='$value' name=filterCheckbox value='$value' onclick='filterByCheckbox(0)'>";
                    echo "<label for='$value'>$value</label><br>";
                }
            }
            ?>
        </div>
        <div class="foundItems">
            <?php
            $isAdmin = false;
            if (isset($_SESSION['User']) && $user->is_admin()) {
                $isAdmin = true;
                echo "<button onclick=\"window.location.href='/products/edit.php?id=0'\">ADD PRODUCT</button>";
            }

            $beers = $populate->found(false, "");
            $beerCard = new BeerCard();

            foreach ($beers as $beer) {
                echo $beerCard->show($beer->getId(), $isAdmin);
            }
            ?>
        </div>
    </div>
</body>

</html>
