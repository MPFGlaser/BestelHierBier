<?php
    function registerNewUser($userName, $passWord, $email){
        include('opendb.php');
        try{
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO Users (UserName, PassWord, EMail) VALUES ('".$userName."', '".md5($passWord)."', '".$email."')";
            $sqlSent = $db->prepare($sql);
            $sqlSent->execute();
            $_SESSION['UserName'] = $userName;
            return true;
        }catch(PDOException $ex) {
            die("Error: ". $ex->getMessage());
        }
    }

    function loginUser($userName, $passWord){
        include('opendb.php');
        try{
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT ID FROM Users WHERE UserName = '".$userName."' AND PassWord = '".md5($passWord)."'";
            $sqlSent = $db->prepare($sql);
            $sqlSent->execute();
            $results = $sqlSent->fetch(PDO::FETCH_ASSOC);
            if(isset($results['ID'])){
                $_SESSION['UserName'] = $userName;
                return true;
            }else{
                return false;
            }
        }catch(PDOException $ex) {
            die("Error: ". $ex->getMessage());
        }
    }
?>
