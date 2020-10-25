<?php
include "./system/db.php";
$page = "";
if (isset($_GET['page']))
    $page = htmlspecialchars($_GET['page']);
switch ($page) {
    case "admin":
    case "home":
    case "login":
    case "view_file":
    case "download_file":
    case "remove_file":
    case"file_list":

        include "./pages/$page.php";
        break;
    default:
        include "./pages/home.php";
}

?>