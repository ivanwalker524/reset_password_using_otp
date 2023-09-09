
    
<?php
session_start();
if(isset($_GET['logout'])){
    session_destroy();
    header('location: ?ref=login');
    exit();
}
$page = isset($_GET['ref']) ? $_GET['ref'] : "create";
require "./files/header.php";
require "./files/$page.php";
require "./files/footer.php";
