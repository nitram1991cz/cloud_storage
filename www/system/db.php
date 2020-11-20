<?php
include "db_data.php";

$mysqli = mysql_connect($servername, $username, $password, $dbname);
mysql_select_db("cloud_storage");

if (!$mysqli) {
    die("Connection failed: " . mysql_error());
}
mysql_select_db($dbname)
    or die("Nepodařilo se zvolit databázi");
?>
