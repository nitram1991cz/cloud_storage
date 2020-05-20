<?php
include "./pages/header.php";

$page = htmlspecialchars($_GET['page']);
switch($page){
    case "admin":
    case "home":
    case "login":
        include "./pages/$page.php";
        break;
    default:
        header("Location: ./pages/home.php");
}
include "./pages/footer.php";
?>