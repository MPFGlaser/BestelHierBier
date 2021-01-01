<?php
//For error viewing
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class_name) {
    include './php/' . $class_name . '.php';
});
require_once './php/mysql_credentials.php';
include_once('views/header.php');

use Controllers\UserController;
use Models\User;

if (!$user->is_admin()) {
    header("Location: /index.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <title>Bestel Hier Bier</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_mobile.css">
</head>

<body>
    <br>
    <div class="adminContent">
        <button onclick="window.location.href='/products/edit.php?id=0'">ADD PRODUCT</button>
    </div>
</body>

</html>