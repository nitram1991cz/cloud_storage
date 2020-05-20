<?php
$page = htmlspecialchars($_GET['page']);
include "./pages/$page.php";
?>