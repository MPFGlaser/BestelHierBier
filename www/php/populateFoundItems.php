<?php
    function populatePrintFoundItems($isSearch, $searchString){
        if($isSearch){
            include_once('product.php');
        }
        return getProductByName($searchString);
    }
?>
