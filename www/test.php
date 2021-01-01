<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/error_viewing.php';
include_once($_SERVER['DOCUMENT_ROOT'].'/php/Views/header.php');

use Controllers\BeerController;

$test = new BeerController();

// print_r($test->getByFilter(["Van Moll"]));
print_r(array_values($test->getCategories()));
