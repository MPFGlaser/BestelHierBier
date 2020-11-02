<?php
    function populatePrintFoundItems($isSearch, $searchString){
        require_once('product.php');

        if(!$isSearch){
            return getAllProducts();
        }
    }
?>
