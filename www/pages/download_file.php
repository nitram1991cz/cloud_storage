<?php

$file_id=$_GET['file_id'];
$sql = "SELECT * FROM files where file_id='$file_id'";
$result = mysqli_query($mysqli, $sql);
$file=mysqli_fetch_assoc($result);

$a = 'C:/REPOSITORIES/cloud_storage/data/'.$file['file_id'];

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($file['file_name']).'"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
//header('Content-Length: ' . filesize($file['file_id']));
flush();
readfile($a);
die();

?>