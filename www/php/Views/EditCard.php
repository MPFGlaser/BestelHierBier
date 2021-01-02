<?php

namespace Views;

use Controllers\BeerController;
use Models\Beer;
use Image;

class EditCard
{
    public function show($id)
    {
        $checkbox = "";
        $name = "";
        $brewery = "";
        $category = "";
        $price = "";
        $abv = "";
        $description = "";
        $country = "";
        $size = "";
        $imageURL = "";

        if($id != 0)
        {
            $beerController = new BeerController();
            $beer = $beerController->getById($id);
            $this->doesBeerExist($beer);
            if ($beer->getAvailable() == '1') {
                $checkbox = "checked='checked'";
            }
            $name = $beer->getName();
            $brewery = $beer->getBrewery();
            $category = $beer->getCategory();
            $price = $beer->getPrice();
            $abv = $beer->getAbv();
            $description = $beer->getDescription();
            $country = $beer->getCountry();
            $size = $beer->getSize();
            $imageURL = $beer->getImageURL();
        }

        
        $html =
            '<div class="editForm">' .
            '<form method="POST" name="editForm" enctype="multipart/form-data">' .
            '<label>Available: </label>' .
            '<label class=" switch"><input type=checkbox name="available" ' . $checkbox . '/>' .
            '<span class="slider round"></span>' .
            '</label>' .
            '<div class="editForm-image">' .
            '<img src="/images/' . $imageURL . '" alt="' . $name . '" />.
                </div>' .
            '<br><br>' .
            '<label>Name: <input type="text" name="name" value="' . $name . '" /></label>' .
            '<label>Brewery: <input type="text" name="brewery" value="' . $brewery . '" /></label>' .
            '<label>Category: <input type="text" name="category" value="' . $category . '" /></label>' .
            '<label>Price(€): <input type="text" name="price" value="' . $price . '" /></label>' .
            '<label>ABV(%): <input type="text" name="abv" value="' . $abv . '" /></label>' .
            '<label>Description: <textarea name="description" rows="10" cols="50">' . $description . '</textarea></label>' .
            '<label>Country: <input type="text" name="country" value="' . $country . '" /></label>' .
            '<label>Size(ml): <input type="text" name="size" value="' . $size . '" /></label>' .
            '<label>Change image:' .
            '<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />' .
            '<input type="file" name="fileToUpload" id="fileToUpload"></label>' .
            '<br /> <br />' .
            '<div>' .
            '<button type="submit" name="cancel">Cancel</button>' .
            '<button type="reset" name="reset">Reset</button>' .
            '<button type="submit" name="save">Save</button>' .
            '</div>' .
            '</form>' .
            '</div>';
        return $html;
    }

    public function save($id)
    {
        $beerController = new BeerController();
        $beer = $beerController->getById($id);
        $checked = 0;

        if (isset($_POST['available'])) {
            $checked = 1;
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

        // Creates a beer object with the right details. Will be validated and then sent to either the create or update function.
        $beerToSave = new Beer($beerDetails);

        if ($beerToSave->validate()) {
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

    public function generateTitle($id)
    {
        $html = '';
        if($id != 0)
        {
            $beerController = new BeerController();
            $beer = $beerController->getById($id);
            $this->doesBeerExist($beer);
            $html .= 'Editing '.$beer->getName().' by '.$beer->getBrewery();
        }
        else
        {
            $html .= 'Add a new beer';
        }
        $html .= ' - Bestel Hier Bier';
        return $html;
    }

    private function doesBeerExist($beer)
    {
        if($beer == null)
        {
            goHome();
        }
    }
}
