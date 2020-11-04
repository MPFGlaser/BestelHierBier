<?php
function checkWhatToUpdate($newUsername, $newEmail, $newPassword, $userName, $email, $password, $id){
    if($newUsername && $newEmail && $newPassword){
        return updateAllInformation($userName, $email, $password, $id);
    }else if($newUsername && $newEmail){
        return updateUsernameEmail($userName, $email, $id);
    }else if($newUsername && $newPassword){
        return updateUsernamePassword($userName, $password, $id);
    }else if($newEmail && $newPassword){
        return updateEmailPassword($email, $password, $id);
    }else if($newUsername){
        return updateUsername($userName, $id);
    }else if($newEmail){
        return updateEmail($email, $id);
    }else if($newPassword){
        return updatePassword($password, $id);
    }else{
        return false;
    }
}

function updateAllInformation($userName, $email, $password, $id){
    include('opendb.php');
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE Users SET UserName=?, PassWord=?, EMail=? WHERE ID=?";
        $sqlSent = $db->prepare($sql);
        if ($sqlSent->execute([$userName, $email, md5($password), $id])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }
}

function updateUsernameEmail($userName, $email, $id){
    include('opendb.php');
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE Users SET UserName=?, EMail=? WHERE ID=?";
        $sqlSent = $db->prepare($sql);
        if ($sqlSent->execute([$userName, $email, $id])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }

}

function updateUsernamePassword($userName, $password, $id){
    include('opendb.php');
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE Users SET UserName=?, PassWord=? WHERE ID=?";
        $sqlSent = $db->prepare($sql);
        if ($sqlSent->execute([$userName, md5($password), $id])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }

}

function updateEmailPassword($email, $password, $id){
    include('opendb.php');
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE Users SET EMail=?, PassWord=? WHERE ID=?";
        $sqlSent = $db->prepare($sql);
        if ($sqlSent->execute([$email, md5($password), $id])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }

}

function updateUsername($userName, $id){
    include('opendb.php');
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE Users SET UserName=? WHERE ID=?";
        $sqlSent = $db->prepare($sql);
        if ($sqlSent->execute([$userName, $id])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }

}

function updateEmail($email, $id){
    include('opendb.php');
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE Users SET EMail=? WHERE ID=?";
        $sqlSent = $db->prepare($sql);
        if ($sqlSent->execute([$email, $id])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }

}

function updatePassword($password, $id){
    include('opendb.php');
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE Users SET PassWord=? WHERE ID=?";
        $sqlSent = $db->prepare($sql);
        if ($sqlSent->execute([md5($password), $id])) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $ex) {
        die("Error: " . $ex->getMessage());
    }

}
?>
