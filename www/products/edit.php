<?php
//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once('../php/classes/userClass.php');
include('../php/opendb.php');
include('../php/uploadFile.php');
include_once('../views/header.php');
include_once('../php/product.php');

if (!$user->is_admin()) {
    header("Location: /index.php");
    die();
}
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
    <div class="editForm">
        <?php
        $id = $_GET['id'];
        $beer = getProduct($id);
        ?>

        <form method="POST" name="editForm" enctype="multipart/form-data">
            <label>Available: </label>
            <label class=" switch"><input type=checkbox name="available" <?php if ($beer->is_available() == '1') echo "checked='checked'"; ?> />
            <span class="slider round"></span>
            </label><br><br>
            <label>Name: <input type="text" name="name" value="<?= $beer->get_name() ?>" /></label>
            <label>Brewery: <input type="text" name="brewery" value="<?= $beer->get_brewery() ?>" /></label>
            <label>Category: <input type="text" name="category" value="<?= $beer->get_category() ?>" /></label>
            <label>Price: <input type="text" name="price" value="<?= $beer->get_price() ?>" /></label>
            <label>ABV: <input type="text" name="abv" value="<?= $beer->get_abv() ?>" /></label>
            <label>Description: <textarea name="description" rows="10" cols="50"><?= $beer->get_description() ?></textarea></label>

            <label>Country: <input type="text" name="country" value="<?= $beer->get_country() ?>" /></label>
            <label>Size: <input type="text" name="size" value="<?= $beer->get_size() ?>" /></label>
            <label>imageURL: <input type="text" name="imageURL" value="<?= $beer->get_imageURL() ?>" /></label>
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
            <input type="file" name="fileToUpload" id="fileToUpload"> <br />
            <div>
                <button type="submit" name="cancel">Cancel</button>
                <button type="reset" name="reset">Reset</button>
                <button type="submit" name="save">Save</button>
            </div>
        </form>
        <!-- <form action="../php/uploadFile.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <input type="submit" value="Upload Image" name="submit">
        </form> -->

        <?php
        if (isset($_POST['save'])) {
            $checked = null;
            // if(isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name'])){
            //     $target_file = basename($_FILES["fileToUpload"]["name"]);
            //     // upload($target_file);
            // }
            // $_POST['fileToUpload']->upload();

            $uploadInstance = new Image();
            $uploadInstance->upload();


            if (isset($_POST['available'])) {
                $checked = 1;
            } else {
                $checked = 0;
            }

            if ($id != 0) {
                if (editProduct($id, $_POST['name'], $_POST['brewery'], $_POST['category'], $_POST['price'], $_POST['abv'], $_POST['description'], $checked, $_POST['country'], $_POST['size'], $_FILES['fileToUpload']['name'])) {

                    // header("Location: /index.php");
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

        if (isset($_POST['cancel'])) {
            header("Location: /index.php");
        }
        ?>
    </div>
</body>

</html>