<?php
//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../php/classes/userClass.php');
include('../php/opendb.php');
include_once('../views/header.php');
include_once('../php/product.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/style_mobile.css">
</head>

<body>
    <div>
        <?php
        $id = $_GET['id'];
        $beer = getProduct($id);
        ?>
        <div class="productPage">
            <title><?= $beer->get_name() ?> by <?= $beer->get_brewery() ?> - Bestel Hier Bier</title>
            <div class="productPage-title">
                <button onclick="window.location.href='/index.php'">RETURN</button>
                <h1><?= $beer->get_name() ?> - <?= $beer->get_category() ?> (<?= $beer->get_abv() ?>)</h1>
                <a href=../images/<?= $beer->get_imageURL() ?>> <img src=../images/<?= $beer->get_imageURL() ?> alt="<?= $beer->get_name() ?>" /> </a>
            </div>
            <div>
                <h4>Description</h4>
                <p><?= $beer->get_description() ?></p>

                <br>
                <div>Brewed by <?= $beer->get_brewery() ?> in <?= $beer->get_country() ?></div>
            </div>
        </div>
    </div>
</body>

</html>
