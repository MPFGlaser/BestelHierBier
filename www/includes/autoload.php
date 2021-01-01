<?php
spl_autoload_register(function ($class_name) {
    include $_SERVER['DOCUMENT_ROOT'].'/php/' . $class_name . '.php';
});
require_once $_SERVER['DOCUMENT_ROOT'].'/php/mysql_credentials.php';
