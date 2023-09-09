<?php
require "./files/includes/db.php";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePassword'])){
    if(strlen($_POST['password']) < 6) $errors[]= "Password has't to be lessthan 6 characters";
    else if(strlen($_POST['cpassword']) < 1) $errors[]= "Confirm password is required!";
    else{
        $pwd = $_POST['password'];
        $cpwd = $_POST['cpassword'];
        $hashed = password_hash($pwd,PASSWORD_DEFAULT);
        
        //check if password match
        if($pwd != $cpwd){
            $errors[]= "Password not match";
        }else{
            $hashed = password_hash($pwd,PASSWORD_DEFAULT);
            $email = $_SESSION['email'];
            $updatePassword = "UPDATE prepared SET password =? WHERE email =?";
            $stmt=$conn->prepare($updatePassword) or die($conn->error);
            $stmt->bind_param("ss",$hashed, $email);
            $stmt->execute();
            $stmt->close();
            unset($email);
            session_destroy();
            header('location: ?ref=login');

        }
    }
}