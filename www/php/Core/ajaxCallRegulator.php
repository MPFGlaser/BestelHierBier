<?php
/*
 * This class regulates all of the calls to php functions made by ajax. The way
 * this is done is by the following switch statement, instead of ajax calling to
 * a specific function it passes a functionId which works in the same way a
 * function name would. It executes the code in this block as if it were a function.
 */

namespace Core;

include $_SERVER['DOCUMENT_ROOT'] . '/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/error_viewing.php';

session_start();

use Core\PopulateFoundItems;
use Views\BeerCard;

$beerCard = new BeerCard();

$isAdmin = false;
if (isset($_SESSION['User'])) {
    $user = unserialize($_SESSION['User']);
    if ($user->is_admin()) {
        $isAdmin = true;
    }
}

switch ($_POST['functionId']) {
    case 1:
        // Find beers by search string.
        $populate = new PopulateFoundItems();
        $beers = $populate->found(true, $_POST['searchString']);
        $results = "";

        if ($isAdmin) {
            $results .= '<button onclick=\"window.location.href="/products/edit.php?id=0"">ADD PRODUCT</button>';
        }

        foreach ($beers as $beer) {
            // Make sure it knows about admin stuff
            $results .= $beerCard->show($beer->getId(), $isAdmin);
        }

        echo $results;
        break;
    case 2:
        // Find beers by selection of checkboxes.
        $populate = new PopulateFoundItems();
        $beers = $populate->foundByFilter(json_decode(stripslashes($_POST['checkedArray'])));
        $results = "";

        if ($isAdmin) {
            $results .= '<button onclick=\"window.location.href="/products/edit.php?id=0"">ADD PRODUCT</button>';
        }

        foreach ($beers as $beer) {
            // Make sure it knows about admin stuff
            $results .= $beerCard->show($beer->getId(), $isAdmin);
        }

        echo $results;
        break;

    default:
        // In case someone accidentaly stumbles accros this file.
        echo "Not allowed";
        break;
}
