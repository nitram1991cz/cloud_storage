<?php
$page = htmlspecialchars($_GET['page']);
switch($page){
    case "admin":
    case "home":
    case "login":
        include "./pages/$page.php";
        break;
    default:
        include "./pages/home.php";
}

?>