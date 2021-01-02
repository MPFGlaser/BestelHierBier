<?php
if (isset($_SESSION['User'])) {
    $user = unserialize($_SESSION['User']);
    if (!$user->is_admin()) {
        goHome();
    }
} else {
    goHome();
}

function goHome()
{
    header('Location: /index.php');
    die();
}
