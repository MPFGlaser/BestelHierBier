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
            </label>
            <div class="editForm-image">
                <img src="/images/<?= $beer->get_imageURL() ?>" alt="<?= $beer->get_name() ?>" /> </div>
            <br><br>
            <label>Name: <input type="text" name="name" value="<?= $beer->get_name() ?>" /></label>
            <label>Brewery: <input type="text" name="brewery" value="<?= $beer->get_brewery() ?>" /></label>
            <label>Category: <input type="text" name="category" value="<?= $beer->get_category() ?>" /></label>
            <label>Price: <input type="text" name="price" value="<?= $beer->get_price() ?>" /></label>
            <label>ABV: <input type="text" name="abv" value="<?= $beer->get_abv() ?>" /></label>
            <label>Description: <textarea name="description" rows="10" cols="50"><?= $beer->get_description() ?></textarea></label>

            <label>Country: <input type="text" name="country" value="<?= $beer->get_country() ?>" /></label>
            <label>Size: <input type="text" name="size" value="<?= $beer->get_size() ?>" /></label>
            <label>Change image:
                <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                <input type="file" name="fileToUpload" id="fileToUpload"></label>
            <br /> <br />
            <div>
                <button type="submit" name="cancel">Cancel</button>
                <button type="reset" name="reset">Reset</button>
                <button type="submit" name="save">Save</button>
            </div>
        </form>

        <?php
        if (isset($_POST['save'])) {
            if(checkIfAllInformationIsFilledIn($_POST['name'], $_POST['brewery'], $_POST['category'], $_POST['price'], $_POST['abv'], $_POST['description'], $_POST['country'], $_POST['size'])){
                $checked = null;

                if (isset($_POST['available'])) {
                    $checked = 1;
                } else {
                    $checked = 0;
                }

                if (isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name'])) {

                    $uploadInstance = new Image();
                    $uniqueFileName = uniqid(). '.' . strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
                    $uploadInstance->upload($uniqueFileName);

                    if ($id != 0) {
                        if (editProduct($id, $_POST['name'], $_POST['brewery'], $_POST['category'], $_POST['price'], $_POST['abv'], $_POST['description'], $checked, $_POST['country'], $_POST['size'], $uniqueFileName)) {

                            header("Location: /index.php");
                            die();
                        } else {
                            echo "Something went wrong editing the product";
                        }
                    } else {
                        if (newProduct($_POST['name'], $_POST['brewery'], $_POST['category'], $_POST['price'], $_POST['abv'], $_POST['description'], $checked, $_POST['country'], $_POST['size'], $uniqueFileName)) {
                            header("Location: /index.php");
                            die();
                        } else {
                            echo "Something went wrong adding the product";
                        }
                    }
                } else {
                    if ($id != 0) {
                        if (editProduct($id, $_POST['name'], $_POST['brewery'], $_POST['category'], $_POST['price'], $_POST['abv'], $_POST['description'], $checked, $_POST['country'], $_POST['size'], $beer->get_imageURL())) {

                            header("Location: /index.php");
                            die();
                        } else {
                            echo "Something went wrong editing the product";
                        }
                    } else {
                        if (newProduct($_POST['name'], $_POST['brewery'], $_POST['category'], $_POST['price'], $_POST['abv'], $_POST['description'], $checked, $_POST['country'], $_POST['size'], $beer->get_imageURL())) {
                            header("Location: /index.php");
                            die();
                        } else {
                            echo "Something went wrong adding the product";
                        }
                    }
                }
            }else{
                echo "Please make sure all information is entered and valid";
            }
        }

        if (isset($_POST['cancel'])) {
            header("Location: /index.php");
        }

        function checkIfAllInformationIsFilledIn($name, $brewery, $category, $price, $abv, $description, $country, $size){
            if($name == "" || $brewery == "" || $category == "" || $price == "" || $abv == "" || $description == "" || $country == "" || $size == "" || $price <= 0){
                return false;
            }
            return true;
        }
        ?>
    </div>
</body>

</html>
