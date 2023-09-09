<?php require "./files/includes/verifyEmail.inc.php" ?>
<div class="mx-wd auto">
    <div class="container-form">
        <form method="post">
            <div class="form_header">
                <h2>Enter the verification code to reset your password</h2>
            </div>
            <?php
            if (isset($_SESSION['message'])) {
            ?>
                <div class="alert"><?php echo $_SESSION['message'] ?></div>
            <?php
            }
            ?>
            <?php
            if (!empty($errors)) {
                echo '<div class="errors" id="showError">';
                foreach ($errors as $error) {
                    echo '<p>' . $error . '</p>';
                    echo '</div>';
                }
            } else {
                echo '<div id="showError"></div>';
            }
            ?>
            <div class="errors">
                <?php
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                ?>
                        <p><?= $error ?></p>
                <?php
                    }
                }
                ?>
            </div>
            <div class="input_controller">
                <input type="number" name="OTPverify" placeholder="Verification Code">
            </div>
            <div class="input_controller">
                <input type="submit" class="btn" name="verifyEmail" value="Verify">
            </div>
        </form>
    </div>
</div>