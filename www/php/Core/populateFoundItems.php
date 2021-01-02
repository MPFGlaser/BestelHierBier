<?php

namespace Core;

include $_SERVER['DOCUMENT_ROOT'] . '/includes/autoload.php';

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
