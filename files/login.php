<?php
require "./files/includes/login.inc.php";
?>
<div class="mx-wd auto">
    <div class="container-form">
        <form method="post">
            <div class="form_header">
                <h2>Login account using prepared statement</h2>
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
                <label for="">Email:</label>
                <input type="email" name="uname">
            </div>
            <div class="input_controller">
                <label for="">Password:</label>
                <input type="password" name="password">
            </div>
            <div class="input_controller forgotpwd">
                <a href="?ref=forgot">Forgot password?</a>
            </div>
            <div class="input_controller">
                <input type="submit" class="btn" name="login">
            </div>
            <div class="select">
                <p>Not have account? <a href="?ref=create">create</a></p>
            </div>
        </form>
    </div>
</div>