<?php

include_once('includes/functions.php');

$page = explode('/', $_GET['u'] ?? "");

if (isset($page[2])) {
    $tag = "../../";
} else if (isset($page[1])) {
    $tag = "../";
} else {
    $tag = "";
}
$ignoreFiles = ['favicon.ico', 'robots.txt', 'sitemap.xml']; // ide tehetsz több fájlt is

if (!in_array($page[0], $ignoreFiles)) {
    logView($page[0]);
}

// Oldal betöltése
switch($page[0]){
    case "":
        include_once('pages/main.php');
        break;
    case "main":
        include_once('pages/main.php');
        break;
    case "admin":
        include_once('pages/admin.php');
        break;
    case "webadmin":
        include_once('pages/webadmin.php');
        break;
    case "login":
        include_once('pages/login.php');
        break;
    case "register":
        include_once('pages/register.php');
        break;
}
?>
