<?php
include "header.php";
session_start();
?>
    <h1> Home </h1>
<?php
if ($_SESSION != []) {
    echo("Prihlasen");
} else {
    echo("neprihlasen");
    header("Location: index.php?page=login");
    // include "./pages/login.php";
}
include "footer.php";
?>