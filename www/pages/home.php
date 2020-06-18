<?php
include "header.php";
?>
    <h1> Home </h1>
<?php
if ($_SESSION['logged_username']) {
    echo("Prihlasen");
} else {
    echo("neprihlasen");
    header("Location: index.php?page=login");
    exit;
}
include "footer.php";
?>