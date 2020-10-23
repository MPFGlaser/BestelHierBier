<?php
session_start();

//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../php/classes/userClass.php');
include('../php/opendb.php');
include('../views/header.php');
include_once('../php/editproduct.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <!-- <title>Bestel Hier Bier</title> -->
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/style_mobile.css">
</head>

<body>

    <div class="mobileLogo">
        <img src="../images/tempLogo.png" alt="Temp Logo" />
    </div>
    <br />
    <div>
        <?php
        $id = $_GET['id'];
        $beer = getProduct($id);
        ?>

        <form method="POST" name="editForm">
            <p>Name: <input type="text" name="name" value="<?= $beer->get_name() ?>" /></p>
            <p>Brewery: <input type="text" name="brewery" value="<?= $beer->get_brewery() ?>" /></p>
            <p>Category: <input type="text" name="category" value="<?= $beer->get_category() ?>" /></p>
            <p>Price: <input type="text" name="price" value="<?= $beer->get_price() ?>" /></p>
            <p>ABV: <input type="text" name="abv" value="<?= $beer->get_abv() ?>" /></p>
            <p>Description: <textarea name="description" rows="10" cols="50"> <?= $beer->get_description() ?></textarea></p>
            <p>Available: <input type=checkbox name="available" <?php if ($beer->is_available() == '1') echo "checked='checked'"; ?> /></p>
            <p>Country: <input type="text" name="country" value="<?= $beer->get_country() ?>" /></p>
            <p>Size: <input type="text" name="size" value="<?= $beer->get_size() ?>" /></p>
            <p>imageURL: <input type="text" name="imageURL" value="<?= $beer->get_imageURL() ?>" /></p>
            <button type="submit" name="save">Save</button>
        </form>

        <?php
        if (isset($_POST['save'])) {
            $checked = null;

            if (isset($_POST['available'])) {
                $checked = 1;
            } else {
                $checked = 0;
            }

            if ($id != 0) {
                if (editProduct($id, $_POST['name'], $_POST['brewery'], $_POST['category'], $_POST['price'], $_POST['abv'], $_POST['description'], $checked, $_POST['country'], $_POST['size'], $_POST['imageURL'])) {
                    header("Location: /index.php");
                    die();
                } else {
                    echo "Something went wrong editing the product";
                }
            } else {
                if (newProduct($_POST['name'], $_POST['brewery'], $_POST['category'], $_POST['price'], $_POST['abv'], $_POST['description'], $checked, $_POST['country'], $_POST['size'], $_POST['imageURL'])) {
                    header("Location: /index.php");
                    die();
                } else {
                    echo "Something went wrong adding the product";
                }
            }
        }
        ?>
    </div>
</body>

</html>