<?php

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
        $populate = new PopulateFoundItems();
        echo json_encode($populate->found(true, $_POST['searchString']));
        return;
        break;
    case 2:
        $populate = new PopulateFoundItems();
        echo json_encode($populate->foundByFilter(json_decode(stripslashes($_POST['checkedArray']))));
        return;
        break;

    default:
        echo "Not allowed";
}
