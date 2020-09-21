<?php
    function registerNewUser($userName, $passWord, $email){
        include('opendb.php');
        include_once('classes/userClass.php');
        include_once('classes/userArray.php');

        array_push($users, new User($userName, $email, $passWord));
        // try{
        //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //     $sql = "INSERT INTO Users (UserName, PassWord, EMail) VALUES ('".$userName."', '".md5($passWord)."', '".$email."')";
        //     $sqlSent = $db->prepare($sql);
        //     $sqlSent->execute();
        //     $_SESSION['UserName'] = $userName;
        //     // $_SESSION['user'] = new User($userName, $email, $passWord);
        //     // $GLOBALS['user'] = new User($userName, $email, $passWord);
        //     global $user;
        //     $user = new User($userName, $email, $passWord);
        //     return true;
        // }catch(PDOException $ex) {
        //     die("Error: ". $ex->getMessage());
        // }
    }

    function loginUser($userName, $passWord){
        include('opendb.php');
        include_once('classes/userClass.php');
        include_once('classes/userArray.php');

        $loggedIn = false;
        foreach ($users as $checkUser) {
            if($userName === $checkUser->get_name() && $passWord === $checkUser->get_password()){
                echo "Welcome ".$checkUser->get_name();
                $loggedIn = true;
                break;
            }
        }
        if(!$loggedIn){
            echo "Invlaid Credentials";
        }
        // try{
        //     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //     $sql = "SELECT ID FROM Users WHERE UserName = '".$userName."' AND PassWord = '".md5($passWord)."'";
        //     $sqlSent = $db->prepare($sql);
        //     $sqlSent->execute();
        //     $results = $sqlSent->fetch(PDO::FETCH_ASSOC);
        //     if(isset($results['ID'])){
        //         // $_SESSION['user'] = new User($userName, $email, md5($passWord));
        //         // $GLOBALS['user'] = new User($userName, $email, $passWord);
        //         global $user;
        //         $user = new User($userName, $email, $passWord);
        //         $_SESSION['UserName'] = $userName;
        //         return true;
        //     }else{
        //         return false;
        //     }
        // }catch(PDOException $ex) {
        //     die("Error: ". $ex->getMessage());
        // }
    }
?>
