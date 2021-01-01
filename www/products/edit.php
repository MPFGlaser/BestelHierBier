<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/error_viewing.php';
include_once($_SERVER['DOCUMENT_ROOT'].'/php/Views/header.php');

use Controllers\BeerController;
use Models\Beer;

$beerController = new BeerController();
$user = unserialize($_SESSION['User']);
$id = $_GET['id'];
$beer = $beerController->getById($id);


if (!$user->is_admin()) {
    goHome();
}

function goHome()
{
    header('Location: /index.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <?php
    if ($id != 0) {
    ?><title>Editing <?= $beer->getName() ?> by <?= $beer->getBrewery() ?> - Bestel Hier Bier</title><?php
                                                                                                    } else {
                                                                                                        ?><title>Add a new beer - Bestel Hier Bier</title><?php
                                                                                                                                                        } ?>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/style_mobile.css">
</head>

<body>
    <div class="editForm">
        <form method="POST" name="editForm" enctype="multipart/form-data">
            <label>Available: </label>
            <label class=" switch"><input type=checkbox name="available" <?php if ($beer->getAvailable() == '1'){ echo "checked='checked'"; }?> />
                <span class="slider round"></span>
            </label>
            <div class="editForm-image">
                <img src="/images/<?= $beer->getImageURL() ?>" alt="<?= $beer->getName() ?>" /> </div>
            <br><br>
            <label>Name: <input type="text" name="name" value="<?= $beer->getName() ?>" /></label>
            <label>Brewery: <input type="text" name="brewery" value="<?= $beer->getBrewery() ?>" /></label>
            <label>Category: <input type="text" name="category" value="<?= $beer->getCategory() ?>" /></label>
            <label>Price: <input type="text" name="price" value="<?= $beer->getPrice() ?>" /></label>
            <label>ABV: <input type="text" name="abv" value="<?= $beer->getAbv() ?>" /></label>
            <label>Description: <textarea name="description" rows="10" cols="50"><?= $beer->getDescription() ?></textarea></label>

            <label>Country: <input type="text" name="country" value="<?= $beer->getCountry() ?>" /></label>
            <label>Size: <input type="text" name="size" value="<?= $beer->getSize() ?>" /></label>
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
            if (checkIfAllInformationIsFilledIn($_POST['name'], $_POST['brewery'], $_POST['category'], $_POST['price'], $_POST['abv'], $_POST['description'], $_POST['country'], $_POST['size'])) {
                $checked = null;

                if (isset($_POST['available'])) {
                    $checked = 1;
                } else {
                    $checked = 0;
                }

                $beerToSave;
                $beerDetails = array(
                    "id" => $id,
                    "name" => $_POST['name'],
                    "brewery" => $_POST['brewery'],
                    "category" => $_POST['category'],
                    "price" => $_POST['price'],
                    "abv" => $_POST['abv'],
                    "description" => $_POST['description'],
                    "available" => $checked,
                    "country" => $_POST['country'],
                    "size" => $_POST['size'],
                );

                if (isset($_FILES['fileToUpload']['name']) && !empty($_FILES['fileToUpload']['name'])) {
                    $uploadInstance = new Image();
                    $uniqueFileName = uniqid() . '.' . strtolower(pathinfo($_FILES['fileToUpload']['name'], PATHINFO_EXTENSION));
                    $uploadInstance->upload($uniqueFileName);
                    $beerDetails += ["imageURL" => $uniqueFileName];
                } else {
                    $beerDetails += ["imageURL" => $beer->getImageURL()];
                }

                // Creates a beer object with the right details. Will be sent to either the create or update function.
                $beerToSave = new Beer($beerDetails);

                // Temporarily (unfortunately) removed the validation to see if
                //the update/create succeeded as the Database class does not (yet)
                //return a boolean for succesful execution.
                if ($id != 0) {
                    $beerController->update($beerToSave);
                    goHome();
                } else {
                    $beerController->create($beerToSave);
                    goHome();
                }
            } else {
                echo "Please make sure all information is entered and valid";
            }
        }

        if (isset($_POST['cancel'])) {
            goHome();
        }

        function checkIfAllInformationIsFilledIn($name, $brewery, $category, $price, $abv, $description, $country, $size)
        {
            if ($name == "" || $brewery == "" || $category == "" || $price == "" || $abv == "" || $description == "" || $country == "" || $size == "" || $price <= 0) {
                return false;
            }
            return true;
        }
        ?>
    </div>
</body>

</html>
