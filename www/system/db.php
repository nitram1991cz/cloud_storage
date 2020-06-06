<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cloud_storage";

$mysqli = mysqli_connect($servername, $username, $password, $dbname);

if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
?>