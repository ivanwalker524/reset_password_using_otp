<?php
include "./files/includes/db.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';

$errors=[];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    if (strlen($_POST['fname'] < 1)) $errors[] ="First Name is required";
    else if (strlen($_POST['lname']) < 1)$errors[] ="Last Name is required";
    else if (strlen($_POST['uname']) < 1) $errors[] = "Email is required";
    else if (strlen($_POST['password']) < 6) $errors[] = "Password must be atlest 6 characters";
    else {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $pswd = $_POST['password'];
        $hashed = password_hash($pswd, PASSWORD_DEFAULT);

        //generate a rondom code
        $code = rand(999999, 111111);

        //set Status
        $status = "Not Verified";
        //check username if it is already used
        $check = "SELECT count(*) FROM prepared WHERE email = ?";
        $stm = $conn->prepare($check) or die($conn->error);
        $stm->bind_param("s", $uname);
        $stm->execute();
        $stm->bind_result($checkusername);
        $stm->fetch();
        $stm->close();
        if ($checkusername > 0) {
            $errors[] = "Email is already associated with another account. Please try with different username.";
        } else {
            $sql = "INSERT INTO prepared(firstName,lastName,email,password,code,status) VALUES(?,?,?,?,?,?)";
            $stmi = $conn->prepare($sql) or die($conn->error);
            $stmi->bind_param("ssssss", $fname, $lname, $uname, $hashed,$code,$status);
            $stmi->execute();

            if($stmi){
            
                $mail = new PHPMailer(true);
                try {
                    $mail->SMTPDebug = 2;
                    $mail->isSMTP ();
                    $mail->Host = 'smtp.gmail.com;';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'thecoder609@gmail.com';
                    $mail->Password = 'avjjxqgteegffhyl';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('thecoder609@gmail.com');
                    $mail->addAddress($uname);

                    $mail->isHTML(true);
                    $mail->Subject = 'Email verification code';
                    $mail->Body = 'Your otp code is '. $code;
                    $mail->send();
                    $message = "Mail has been sent successfully!";
                    ?>
                    <script>
                        window.location.href="?ref=otp";
                    </script>
                    <?php
                } catch (Exception $e) {
                    $errors[] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
            $stmi->close();
        }
    }
}
