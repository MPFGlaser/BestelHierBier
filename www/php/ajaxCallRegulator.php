<?php
//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    if(isset($_POST['functionId'])){
        switch($_POST['functionId']){
            case 1:
                include_once('populateFoundItems.php');
                echo json_encode(populatePrintFoundItems(true, $_POST['searchString']));
                return;
            break;
            case 2:
                include_once('populateFoundItems.php');
                echo json_encode(populateFoundItemsByCategory(json_decode(stripslashes($_POST['checkedArray']))));
                return;
            break;
        }
    }else{
        echo "Not allowed";
    }
?>
