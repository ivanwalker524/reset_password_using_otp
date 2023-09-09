<?php
include "./files/includes/db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    if (strlen($_POST['uname']) < 1) $errors[] = "email address cannot be empty!";
    else if (strlen($_POST['password']) < 1) $errors[] = "Password cannot be empty!";
    else {
        $uname = $_POST['uname'];
        $pwd = $_POST['password'];

        $select = "SELECT * FROM prepared WHERE email = ?";
        $prep = $conn->prepare($select) or die($conn->error);
        $prep->bind_param("s", $uname);
        // print_r($prep);
        $prep->execute();
        $cusername = $prep->get_result();
        if (mysqli_num_rows($cusername) == 0) {
            $errors[] = "Email is not valid";
        } else {
            $verify = mysqli_fetch_assoc($cusername);
            // print_r($verify);
         if ($verify['code'] != 0) {
                header("location: ?ref=otp");
                $message= "Please enter your opt code to verify the email";
            }
            elseif (password_verify($pwd, $verify['password'])) {
                $_SESSION['user'] = $verify;
                header('location: ?ref=dashboard');
            } else {
                $errors[] = "wrong password!";
            }
        }
        $prep->close();
    }
}
