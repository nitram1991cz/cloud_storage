<?php
include "header.php";
session_start();
?>
    <h1> Home </h1>
<?php
if ($_SESSION['username'] != "") {
    echo("Prihlasen");
} else {
    echo("neprihlasen");
    header("Location: index.php?page=login");
}
include "footer.php";
?>