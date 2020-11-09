<?php
include "db_data.php";

$mysqli = mysqli_connect($servername, $username, $password, $dbname);

if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}
?>