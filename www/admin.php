<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/error_viewing.php';
include_once($_SERVER['DOCUMENT_ROOT'].'/php/Views/header.php');

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