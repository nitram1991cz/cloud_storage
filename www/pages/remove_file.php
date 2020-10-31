<?php
include "header.php";
include "config.php";
?>
    <h1> Remove file </h1>
<?php

$file_id=htmlspecialchars($_GET['file_id']);
$sql = "DELETE FROM files where file_id='$file_id'";
$result = mysqli_query($mysqli, $sql);

$a = $ADRESAR.$file_id;
unlink($a);
header("Location: index.php?page=file_list");
?>