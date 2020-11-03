<?php
    function populatePrintFoundItems($isSearch, $searchString){
        if($isSearch){
            include_once('product.php');
        }
        return getProductByName($searchString);
    }

    function populateFoundItemsByCategory($dataArray){
        include_once('product.php');
        return getProductByCategory($dataArray);
    }
?>
