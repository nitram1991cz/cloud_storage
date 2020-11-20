<?php
include "header.php";
if (!$_SESSION['logged_username']) {
    header("Location: index.php?page=login");
    exit;
}
echo($status);
include "menu.php";
?>
    <h1> Home </h1>

<?php
include "footer.php";
?>