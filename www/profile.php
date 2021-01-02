<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/autoload.php';
include $_SERVER['DOCUMENT_ROOT'].'/includes/error_viewing.php';
include_once($_SERVER['DOCUMENT_ROOT'].'/php/Views/header.php');

use Controllers\UserController;
use Models\User;

$userController = new UserController();

?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <title>Bestel Hier Bier</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/style_mobile.css">
    <script src="/js/formValidation.js"></script>
</head>

<body>
    <?php
    if (isset($_SESSION['User'])) {
        $user = unserialize($_SESSION['User']);
    } else {
        header("Location: https://bestelhierbier.nl/login.php");
        die();
    }
    ?>
    <div class="profile">
        <?php
        echo "<form method='post' name='editInformation' id='editInformation' onsubmit='return validateEditUserData()'>";
        echo "<label>Change username: <input type='text' required name='username' value=" . $user->get_name() . "></label>";
        echo "<label>Change email: <input type='text' required name='email' value=" . $user->get_email() . "></label>";
        echo "<label>Change password: <input type='password' required name='passwordNew'></label>";
        echo "<label>Confirm password: <input type='password required' name='passwordConfirm'></label>";
        echo "<div><button type='submit' name='saveNewInformation'>Save</button></div>";
        echo "</form>";

        if (isset($_POST['saveNewInformation'])) {
            $newUsername = false;
            $newEmail = false;
            $newPassword = false;

            if ($_POST['username'] != $user->get_name() && $_POST['username'] != "") {
                $newUsername = true;
            }
            if ($_POST['email'] != $user->get_email() && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $newEmail = true;
            }
            if ($_POST['passwordNew'] != "" && $_POST['passwordNew'] == $_POST['passwordConfirm']) {
                $newPassword = true;
            }
            if ($newUsername || $newEmail || $newPassword) {
                $data = array(
                    "UserName" => $_POST['username'],
                    "EMail" => $_POST['email'],
                    "admin" => $user->is_admin(),
                    "ID" => $user->get_id()
                );
                $userWithUpdatedInfo = new User($data);
                $userController->update($userWithUpdatedInfo);

                if ($newPassword) {
                    $userController->updatePassword($userWithUpdatedInfo, $_POST['passwordNew']);
                }

                $_SESSION['User'] = serialize($userWithUpdatedInfo);
                header("Refresh:0");
            } else {
                echo "No new or valid information was entered";
            }
        }
        ?>
    </div>
    <?php
    if ($user->is_admin()) {
        echo "<div class='adminContent'>";
        echo "<button onclick=\"window.location.href='admin.php'\">TO ADMIN PAGE</button>";
        echo "</div>";
    }
    ?>
</body>

</html>
