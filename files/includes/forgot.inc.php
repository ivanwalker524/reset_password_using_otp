<?php
require "./files/includes/db.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "./vendor/autoload.php";

if (isset($_POST['forgot-password'])) {
    if (strlen($_POST['email']) < 1) $errors[] = "Please enter your email";
    else {
        $uname = $_POST['email'];
        $_SESSION['email'] = $uname;

        $emailCheckQuery = "SELECT * FROM prepared WHERE email=?";
        $stmte = $conn->prepare($emailCheckQuery) or die($conn->error);
        $stmte->bind_param("s", $uname);
        $stmte->execute();
        $results = $stmte->get_result();
        $stmte->close();

        //if query run
        if ($results) {
            //if email matched
            if (mysqli_num_rows($results) > 0) {
                $code = rand(999999, 111111);
                $updateQuery = "UPDATE prepared SET code =? WHERE email =?";
                $stmte = $conn->prepare($updateQuery) or die($conn->error);
                $stmte->bind_param("ss", $code, $uname);
                $stmte->execute();
                $stmte->close();
                if ($stmte) {
                    $mail = new PHPMailer(true);
                    try {
                        $mail->SMTPDebug = 2;
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com;';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'thecoder609@gmail.com';
                        $mail->Password = 'avjjxqgteegffhyl';
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        $mail->setFrom('thecoder609@gmail.com');
                        $mail->addAddress($uname);

                        $mail->isHTML(true);
                        $mail->Subject = 'Email verification code for password reset';
                        $mail->Body = 'Your verification code ' . $code;
                        $mail->send();
                        ?>
                        <script>
                            window.location.href = "?ref=verifyEmail";
                        </script>
                        <?php
                        $message = "Mail has been sent successfully!";
                    } catch (Exception $e) {
                        $errors[] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    $errors[] = "Invalid Email Address";
                }
            } else {
                $errors[] = "Failed while checking email from database <br>It looks like the email your entered is invalid!! <br>Please enter the valid email.";
            }
        }
    }
}
