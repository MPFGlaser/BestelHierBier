<?php

$configPath = "../config";
$cssPath = "../css";
$viewPath = "../templates";
$imgPath = "../img";

/* Check session */
include("$configPath/session.php");

/* Session expiry */
include("$configPath/session_expiry.php");

/* Include classes */
include_once("../config/autoload.inc.php");

$controller = new UserController();
$row = $controller->getUser($_SESSION['userId']);

if (isset($_POST['infoSubmit'])) {

    if ($row['address'] != $_POST['address']) $address = $_POST['address'];
    else $address = $_POST['address2'];
    if ($row['city'] != $_POST['city']) $city = $_POST['city'];
    else $city = $_POST['city2'];
    if ($row['postalcode'] != $_POST['postalcode']) $postalcode = $_POST['postalcode'];
    else $postalcode = $_POST['postalcode2'];
    $email = $_POST['email'];
    $bsn = $_POST['bsn'];
    $phonenumber = $_POST['phonenumber'];
    $spousename = $_POST['spousename'];
    $spousephonenumber = $_POST['spousephonenumber'];
    $row = $controller->updateUser($email, $address, $city, $bsn, $postalcode, $phonenumber, $spousename, $spousephonenumber, $_SESSION['userId']);

    //check image change
    if (isset($_FILES['picture']['name']) && !empty($_FILES['picture']['name'])) {
        $file_name = $_FILES['picture']['name'];
        $file_tmp = $_FILES['picture']['tmp_name'];
        move_uploaded_file($file_tmp, $imgPath . "/" . $file_name);
        $row = $controller->updateUserPic($_SESSION['userId'], $file_name);
        $row = $controller->getUser($_SESSION['userId']);
    }
    $row = $controller->getUser($_SESSION['userId']);
}

if (isset($_POST['cancel'])) {
    header("Location: ../index.php");
}

$username = $row['username'];
$functions = $row['functions'];
$surName = $row['surName'];
$firstName = $row['firstName'];
$dateofbirth = $row['dateOfBirth'];
$address = $row['address'];
$city = $row['city'];
$postalcode = $row['postalcode'];
$email = $row['emailAddress'];
$bsn = $row['bsn'];
$phonenumber = $row['phoneNumber'];
$spousename = $row['spouseName'];
$spousephonenumber = $row['spousePhoneNumber'];
$picture = $row['picture'];




?>

<!DOCTYPE html>
<html lang="eng">
<link rel="stylesheet" type="text/css" href="<?php echo $cssPath; ?>/profile.css">

<!-- Include header (links to css files and navbar) -->
<?php require($viewPath . "/header.php") ?>

<body>
    <form action="#" method="POST" enctype="multipart/form-data">
    <div id="page-container">
    <div id="content-wrap">
    <div id="agenda">
    <div id="upper">
    <div id="uppermiddle">
    <?php if ($picture == null || empty($picture)) { ?>
        <img class="profilepic" src="<?php echo $imgPath; ?>/profilepic.png"><BR>
    <?php
    } else { ?>
        <img class="profilepic" src="<?php echo $imgPath . "/" . $picture; ?>"><BR>
    <?php
    }
    ?>
    <input type="file" id='btn_chPass' name='picture' accept="image/*" value="Upload picture">
    <h3 class='h3info'>Username: <span class="span"><?php echo $username; ?></span> &nbsp;&nbsp;&nbsp;<a href='updatePass.php' id='btn_chPass'>Change Password</a></h3>
    <h3 class='h3info'>Job title: <span class="span"><?php echo $functions; ?></span></h3>
    <h3 class='h3info'>Name: <span class="span"><?php echo $surName; ?> <?php echo $firstName; ?></span></h3>
    <h3 class='h3info'>Date of Birth: <span class="span"><?php echo $dateofbirth; ?></span></h3>
    <BR><BR>
    <div id="rightsidemobile">
        <div id="columnmob">
            <h3 class='h3info'>Address:</h3>
            <h3 class='h3info'>City:</h3>
            <h3 class='h3info'>Postal code:</h3>
        </div>
        <div id="columnmob">
            <p><input type="text" class="form-control1" name="address2" value="<?php echo $address; ?>"></p>
            <p><input type="text" class="form-control1" name="city2" value="<?php echo $city; ?>"></p>
            <p><input type="text" class="form-control1" name="postalcode2" value="<?php echo $postalcode; ?>"></p>
        </div>
    </div>
    <div id="upperright">
        <div id="column">
            <h3 class='h3info'>Email:</h3>
            <h3 class='h3info'>BSN:</h3>
            <h3 class='h3info'>Phone number:</h3>
            <h3 class='h3info'>Spouse's name:</h3>
            <h3 class='h3info'>Spouse's phone number:</h3>
        </div>
        <div id="column">
            <p><input type="text" class="form-control" name="email" value="<?php echo $email; ?>"></p>
            <p><input type="text" class="form-control" name="bsn" value="<?php echo $bsn; ?>"></p>
            <p><input type="text" class="form-control" name="phonenumber" value="<?php echo $phonenumber; ?>"></p>
            <p><input type="text" class="form-control2" name="spousename" value="<?php echo $spousename; ?>"></p>
            <p><input type="text" class="form-control2" name="spousephonenumber" value="<?php echo $spousephonenumber; ?>"></p>
        </div>
    </div>
</div>
</div>
<div id="rightside">
<h3 class='h3info'>Address:<BR><input type="text" class="form-control1" name="address" value="<?php echo $address; ?>"></h3>
<h3 class='h3info'>City:<BR><input type="text" class="form-control1" name="city" value="<?php echo $city; ?>"></h3>
<h3 class='h3info'>Postal code:<BR><input type="text" class="form-control1" name="postalcode" value="<?php echo $postalcode; ?>"><code></code></h3>
</div>
<div id='btnBlock'>
<div id="column">
    <center><button type='submit' name='cancel' id='btn_form'>Cancel</button></center>
</div>
<div id="column">
    <center><button type='submit' name='infoSubmit' id='btn_form'>Confirm</button></center>
</div>
</div>

</div>
</div>
</div>
</form>
</body>
<!-- Include footer -->
<?php include($viewPath . "/footer.php")
?>

</html>