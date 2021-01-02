<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/error_viewing.php';
include_once($_SERVER['DOCUMENT_ROOT'] . '/php/Views/header.php');
include $_SERVER['DOCUMENT_ROOT'] . '/includes/admin_only.php';

use Views\EditCard;

$id = $_GET['id'];
$editCard = new EditCard();

if($id < 0)
{
    goHome();
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <title><?php echo $editCard->generateTitle($id) ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/style_mobile.css">
</head>

<body>
    <?php
    echo $editCard->show($id);
    if (isset($_POST['save'])) {
        $editCard->save($id);
    }

    if (isset($_POST['cancel'])) {
        goHome();
    }
    ?>
</body>

</html>