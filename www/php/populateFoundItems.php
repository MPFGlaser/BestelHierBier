<?php
    function populatePrintFoundItems($isSearch, $searchString){
        if($isSearch){
            include_once('product.php');
        }
        return getProductByName($searchString);
    }

    function populateFoundItemsByFilter($dataArray){
        include_once('product.php');
        return getProductByFilter($dataArray);
    }
?>
