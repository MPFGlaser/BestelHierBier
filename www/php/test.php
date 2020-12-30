<?php

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
require_once './mysql_credentials.php';

use Controllers\BeerController;

$test = new BeerController();

print_r($test->getByFilter(["Van Moll"]));
