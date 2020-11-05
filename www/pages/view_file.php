<?php
include "config.php";
$file_id = $_GET['file_id'];

header('Content-Type: image/png');

$image = $ADRESAR . $file_id;

readfile($image);
?>
