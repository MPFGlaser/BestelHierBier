<?php

namespace Core;

spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'].'/php/'.$class_name . '.php';
});
require_once $_SERVER['DOCUMENT_ROOT'].'/php/mysql_credentials.php';

use Controllers\BeerController;

class PopulateFoundItems
{
    function found($isSearch, $searchString)
    {
        $beerController = new BeerController();
        if ($isSearch) {
            return $beerController->getByNameOrBrewery($searchString);
        }
        return $beerController->getAll();
    }

    function foundByFilter($dataArray)
    {
        $beerController = new BeerController();
        return $beerController->getByFilter($dataArray);
    }

    function foundByPrice($price){
        $beerController = new BeerController();
        return $beerController->getByPrice($price);
    }
}
