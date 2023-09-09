<?php
require "./files/includes/db.php";
//verify button when clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify'])) {
    $_SESSION['message'] = "";
    if(strlen($_POST['otp']) < 1) $errors[] = "Please Enter verification code";
        else{
        $otp = mysqli_real_escape_string($conn, $_POST['otp']);
        $otp_query = "SELECT * FROM prepared WHERE code = ?";
        $stmt=$conn->prepare($otp_query) or die($conn->error);
        $stmt->bind_param("s", $otp);
        $stmt->execute();
        $result = $stmt->get_result();
        if(mysqli_num_rows($result) > 0){
            $fetch_data= $result->fetch_assoc();
            $fetch_code = $fetch_data['code'];

            $update_status = "Verified";
            $update_code = 0;

            $update_query = "UPDATE prepared SET code=?, status=? WHERE code =?";
            $stm=$conn->prepare($update_query) or die($con->error);
            $stm->bind_param("sss", $update_code, $update_status, $fetch_code);
            $stm->execute();
            $stm->close();

            if ($stmt) {
                header('location: ?ref=login');
            } else {
                $errors[] = "Failed to inserting data in Database!";
            }
        } else {
            $errors[] = "You enter invalid verification code!";
        }
    }
}
