<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/error_viewing.php';
include_once($_SERVER['DOCUMENT_ROOT'].'/php/Views/header.php');

use Controllers\BeerController;

$beerController = new BeerController();

$id = $_GET['id'];
$beer = $beerController->getById($id);
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <title><?= $beer->getName() ?> by <?= $beer->getBrewery() ?> - Bestel Hier Bier</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/style_mobile.css">
</head>

<body>
    <div>
        <div class="productPage">
            <div class="productPage-title">
                <button onclick="window.location.href='/index.php'">RETURN</button>
                <h1><?= $beer->getName() ?> - <?= $beer->getCategory() ?> (<?= $beer->getAbv() ?>%)</h1>
                <a href=../images/<?= $beer->getImageURL() ?>> <img src=../images/<?= $beer->getImageURL() ?> alt="<?= $beer->getName() ?>" /> </a>
            </div>
            <div>
                <h4>Description</h4>
                <p><?= $beer->getDescription() ?></p>

                <br>
                <div>Brewed by <?= $beer->getBrewery() ?> in <?= $beer->getCountry() ?></div>
            </div>
        </div>
    </div>
</body>

</html>
