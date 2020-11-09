<!doctype html>

<html lang="cs-cz">

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="pages/styly.css">
</head>


<body>
<?php
ini_set('session.cookie_lifetime', 30 * 24 * 60 * 60);
session_start();

if (isset($_POST['Logout'])) {
    unset($_SESSION["logged_username"], $_SESSION["id"], $_SESSION["is_logged_user_admin"], $_SESSION['storage_limit']);
    echo("Odhlasen");
}
if ($_SESSION) {
    echo("Uzivatel : " . $_SESSION["logged_username"]);
}
?>
<ul>
    <li>
        <form action="index.php?page=login" method="post">
            <td><input type='submit' name='Logout' value='Logout'></td>
        </form>
    </li>

    <li>
        <form action="index.php?page=upload_file" method="post">
            <td><input type='submit' name='add_file' value='Add file'></td>
        </form>
    </li>

    <li>
        <form action="index.php?page=file_list" method="post">
            <td><input type='submit' name='file_list' value='File list'></td>
        </form>
    </li>

    <li>
        <form action="index.php?page=admin" method="post">
            <td><input type='submit' name='admin' value='Admin'></td>
        </form>
    </li>

    <li>
        <form action="index.php?page=home" method="post">
            <td><input type='submit' name='home' value='Home'></td>
        </form>
    </li>
</ul>
</body>
<?php

?>
