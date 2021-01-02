<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/error_viewing.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/Views/header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Error - Bestel Hier Bier</title>
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/style_mobile.css">
</head>

<body>
    <div>
        <center>
            <p class="errorText">We are sorry, your request was invalid. Click <a href="index">Here</a> to return to the website.</p>
            <img src="/images/Error.gif" />
        </center>
    </div>
</body>

</html>