<?php require "./files/includes/newPassword.inc.php" ?><div class="mx-wd auto">
    <div class="container-form">
        <form method="post">
            <div class="form_header">
                <h2>Create your new password</h2>
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
                <label for="">Password:</label>
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="input_controller">
                <label for="">Confirm password:</label>
                <input type="password" name="cpassword" placeholder="Confirm Password">
            </div>
            <div class="input_controller">
                <input type="submit" class="btn" name="changePassword" value="Save">
            </div>
        </form>
    </div>
</div>