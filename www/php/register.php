<?php
    function registerNewUser($userName, $passWord, $email, $passWordConfirm){
        include('opendb.php');
        include_once('classes/userClass.php');

        try{
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Users (UserName, PassWord, EMail) VALUES (?, ?, ?)";
            $sqlSent = $db->prepare($sql);
            $sqlSent->execute([$userName, md5($passWord), $email]);
            return loginUser($userName, $passWord);
        }catch(PDOException $ex) {
            die("Error: ". $ex->getMessage());
        }

        return false;
    }

    function loginUser($userName, $passWord){
        include('opendb.php');
        include_once('classes/userClass.php');

        try{
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM Users WHERE UserName = ? AND PassWord = ?";
            $sqlSent = $db->prepare($sql);
            $sqlSent->execute([$userName, md5($passWord)]);
            $results = $sqlSent->fetch(PDO::FETCH_ASSOC);
            if(isset($results['ID'])){
                $user = new User($results['UserName'], $results['EMail'], $results['admin'], $results['ID']);
                $_SESSION['User'] = serialize($user);
                return true;
            }else{
                return false;
            }
        }catch(PDOException $ex) {
            die("Error: ". $ex->getMessage());
        }
    }
?>
