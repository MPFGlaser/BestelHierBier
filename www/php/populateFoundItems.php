<?php
    function populatePrintFoundItems($isSearch, $searchString){
        if(!$isSearch){
            return getAllProducts();
        }else{
            include_once('product.php');
            return getProductByName($searchString);
        }
    }
?>
