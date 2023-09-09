<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prepareddb";
$conn = new mysqli($servername,$username,$password,$dbname);
if(!$conn){
    echo "Database failed to connect" . mysqli_error($conn);
}