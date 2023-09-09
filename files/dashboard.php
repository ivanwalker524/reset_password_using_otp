<div class="mx-wd auto">
    <div class="dashboard">
        <div>
            <div style="display: flex; align-items:center;">
                <span style="font-size:17px;font-weight:bolder;">Welcome</span>
                <p style="color: blue; padding:0 5px; font-size:20px;font-weight:bolder;"><?= $_SESSION['user']['firstName'] . " " . $_SESSION['user']['lastName'] ?></p>
            </div>
            <div class="logout">
                <a href="?logout">Logout</a>
            </div>
        </div>
    </div>
</div>