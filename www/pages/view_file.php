<?php
$file_id = $_GET['file_id'];

    header('Content-Type: image/png');

$image = 'C:/REPOSITORIES/cloud_storage/data/' . $file_id;

readfile($image);
?>
