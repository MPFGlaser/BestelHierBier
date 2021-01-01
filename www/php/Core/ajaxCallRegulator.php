<?php
/*
 * This class regulates all of the calls to php functions made by ajax. The way
 * this is done is by the following switch statement, instead of ajax calling to
 * a specific function it passes a functionId which works in the same way a
 * function name would. It executes the code in this block as if it were a function.
 */

namespace Core;
//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'].'/php/' . $class_name . '.php';
});
require_once $_SERVER['DOCUMENT_ROOT'].'/php/mysql_credentials.php';

use Core\PopulateFoundItems;


switch ($_POST['functionId']) {
    case 1:
        // Find beers by search string.
        $populate = new PopulateFoundItems();
        echo json_encode($populate->found(true, $_POST['searchString']));
        return;
        break;
    case 2:
        // Find beers by selection of checkboxes.
        $populate = new PopulateFoundItems();
        echo json_encode($populate->foundByFilter(json_decode(stripslashes($_POST['checkedArray']))));
        return;
        break;

    default:
        // In case someone accidentaly stumbles accros this file.
        echo "Not allowed";
        break;
}
