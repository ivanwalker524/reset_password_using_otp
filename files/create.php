<?php
require "./files/includes/create.inc.php";
?>
<div class="mx-wd auto">
    <div class="container-form">
        <form method="post">
            <div class="form_header">
                <h2>Create account using prepared statement</h2>
            </div>
            <?php
                if(!empty($errors)){
                    echo '<div class="errors" id="showError">';
                    foreach($errors as $error){
                        echo '<p>'.$error.'</p>';
                        echo '</div>';
                    }
                }else{
                    echo '<div id="showError"></div>';
                }
            ?>
            <div class="input_controller">
                <label for="">First Name:</label>
                <input type="text" name="fname" autofocus>
            </div>
            <div class="input_controller">
                <label for="">Last Name:</label>
                <input type="text" name="lname">
            </div>
            <div class="input_controller">
                <label for="">Email:</label>
                <input type="email" name="uname">
            </div>
            <div class="input_controller">
                <label for="">Password:</label>
                <input type="password" name="password">
            </div>
            <div class="input_controller">
                <input type="submit" class="btn" name="create">
            </div>
            <div class="select">
                <p>Already have account? <a href="?ref=login">Login</a></p>
            </div>
        </form>
    </div>
</div>