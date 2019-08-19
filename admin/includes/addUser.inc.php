<?php

if(!isset($_POST['submit'])){

    header("Location: ../add_user.php");
    exit();
} else{
     // ESTABLISH A CONNECTION
     include_once 'dbh.inc.php';

     // SANITIZE THE INPUTS
    $userName = mysqli_real_escape_string($conn,$_POST["userName"]);
    $password = mysqli_real_escape_string($conn,$_POST["pwd"]);
    $passwordConfirm = mysqli_real_escape_string($conn, $_POST["confirmPwd"]);
    $role = mysqli_real_escape_string($conn,$_POST["userType"]);
    $addDate = date("d-m-Y h:i:s a");

    // ERROR HANDLERS

    // Check for empty spaces
    if(empty($userName) || empty($password)  || empty($passwordConfirm) || empty($role)){
        header("Location: ../add_user.php?add_user=empty");
        exit();
    } else{
        // Check if input characters are valid
        if(!preg_match("/^[a-zA-Z]*$/", $userName)){
            header("Location: ../add_user.php?add_user=invalid");
            exit();
        } else{
            // Check if userName already exists in the database
            $sql = "SELECT * FROM `users` WHERE `user_name` = '$userName'";
            $result  = mysqli_query($conn, $sql); 
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
                header("Location: ../add_user.php?add_user=usertaken");
                exit();
            } else{ 
                // check if $password and $passwordConfirm are the same
                if($password != $passwordConfirm){
                    header("Location: ../add_user.php?add_user=wrongpasswords");
                    exit();
                } 
                 else{
                    // Hashing the password
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                    // Insert the user into the database
                    $sql = "INSERT INTO `users` (`user_name`, `user_pwd`, `user_type`) VALUES ('$userName', '$hashedPwd', '$role');";
                    mysqli_query($conn, $sql);
                    header("Location: ../add_user.php?add_user=success");
                    exit();
                }
               
            }
        }
    }
}









