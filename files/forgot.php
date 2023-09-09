<?php require "./files/includes/forgot.inc.php" ?>
<div class="mx-wd auto">
    <div class="container-form">
        <form method="post">
            <div class="form_header">
                <h2>Enter your Email to get verification code</h2>
            </div>
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
                <input type="email" name="email" placeholder="Enter your email">
            </div>
            <div class="input_controller">
                <input type="submit" class="btn" name="forgot-password" value="Check">
            </div>
        </form>
    </div>
</div>