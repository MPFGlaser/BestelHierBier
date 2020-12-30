<?php

namespace Core;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
require_once 'php/mysql_credentials.php';

use Controllers\BeerController;

class PopulateFoundItems
{
    function found($isSearch, $searchString)
    {
        $beerController = new BeerController();
        if ($isSearch) {
            return $beerController->getByName($searchString);
        }
        return $beerController->getAll();
    }

    function foundByFilter($dataArray)
    {
        $beerController = new BeerController();
        include_once('product.php');
        return $beerController->getByFilter($dataArray);
    }
}
