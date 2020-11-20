<?php
ini_set('session.cookie_lifetime', 30 * 24 * 60 * 60);
session_start();

if (isset($_GET['logout'])) {
    unset($_SESSION["logged_username"], $_SESSION["id"], $_SESSION["is_logged_user_admin"], $_SESSION['storage_limit']);
    $status="Odhlasen";
}
if ($_SESSION) {
    $status=("Uzivatel : " . $_SESSION["logged_username"]);
}
else{
    if(!isset($_GET['logout'])) {
        $status="Neprihlasen";
    }
}
?>
