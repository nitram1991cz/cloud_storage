<!doctype html>

<html lang="cs-cz">

<head>
    <meta charset="utf-8"/>

</head>


<body>

<form action="index.php?page=login" method="post">
    <td><input type='submit' name='Logout' value='Logout'></td>
</form>
<?php
ini_set('session.cookie_lifetime', 2630000);
session_start();

if (isset($_POST['Logout'])) {
    unset($_SESSION["logged_username"], $_SESSION["id"], $_SESSION["is_logged_user_admin"]);
    echo("Odhlasen");
}
?>
