<?php
require "./files/includes/db.php";
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verifyEmail'])){
    $_SESSION['message'] = "";
    if(strlen($_POST['OTPverify']) < 1) $errors[] = "Please enter OTP!";
    else{
        $OTPverify = mysqli_real_escape_string($conn,$_POST['OTPverify']);
        $verifyQuery = "SELECT * FROM prepared WHERE code =?";
        $stmtv=$conn->prepare($verifyQuery) or die($conn->error);
        $stmtv->bind_param("s", $OTPverify);
        $stmtv->execute();
        $resultv= $stmtv->get_result();
        $stmtv->close();
        if($resultv){
            if(mysqli_num_rows($resultv) > 0){
                $newQuery = "UPDATE prepared SET code= 0 WHERE code=?";
                $stmv=$conn->prepare($newQuery) or die($conn->error);
                $stmv->bind_param("s", $OTPverify);
                $stmv->execute();
                // $stmv->close();
                header("location: ?ref=newPassword");
            }else {
                $errors[] = "Invalid Verification Code";
            }
        }
    }
} //else {
   // $errors[] = "Failed while Checking verification Code from database!";
//}
