<?php

include_once('includes/functions.php');
include_once('includes/ajax.php');

$page = explode('/', $_GET['u'] ?? "");

if (isset($page[2])) {
    $tag = "../../";
} else if (isset($page[1])) {
    $tag = "../";
} else {
    $tag = "";
}
$ignoreFiles = ['favicon.ico', 'robots.txt', 'sitemap.xml']; // ide tehetsz több fájlt is

$pageRoles = [
        "admin" => "viewAdminPanel"
    ];

$needLoggedPages = ["admin"]; // oldalak amihez szükséges a bejelentkezés
$onlyLoggedOutPages = ["login","register"]; // oldalak amik csak kijelentkezve látszik.

if (in_array($page[0], $needLoggedPages)){
    if (!isset($_SESSION["USER:LOGGED"]) || $_SESSION["USER:LOGGED"] === false){
        $page[0] = "login";
    }
}
if (in_array($page[0], $onlyLoggedOutPages)){
    if (isset($_SESSION["USER:LOGGED"]) || $_SESSION["USER:LOGGED"] === true){
        $page[0] = "main";
    }
}

if (!in_array($page[0], $ignoreFiles)) {
    logView($page[0]);
}

if (isset($_SESSION["USER:LOGGED"]) && $_SESSION["USER:LOGGED"] === true){
    $banData = getBanDataById($_SESSION["USER:DATA"]["id"]);
    if ($banData && $banData["status"] == 0){
        $page[0] = "banned";
    }
}

// Oldal betöltése
switch($page[0]){
    case "":
        include_once('pages/main.php');
        break;
    case "main":
        include_once('pages/main.php');
        break;
    //
    // Admin panel oldalak
    //
    case "admin":
        include_once('instances/header-admin.php');
        include_once('instances/navbar-admin.php');
        include_once('pages/admin.php');
        include_once('instances/footer-admin.php');
        break;
    case "roles":
        include_once('instances/header-admin.php');
        include_once('instances/navbar-admin.php');
        include_once('pages/roles.php');
        include_once('instances/footer-admin.php');
        break;
    case "createRole":
        include_once('instances/header-admin.php');
        include_once('instances/navbar-admin.php');
        include_once('pages/createRole.php');
        include_once('instances/footer-admin.php');
        break;
    case "editRole":
        include_once('instances/header-admin.php');
        include_once('instances/navbar-admin.php');
        include_once('pages/editRole.php');
        include_once('instances/footer-admin.php');
        break;
    case "allAccounts":
        include_once('instances/header-admin.php');
        include_once('instances/navbar-admin.php');
        include_once('pages/allAccounts.php');
        include_once('instances/footer-admin.php');
        break;
    case "editUser":
        include_once('instances/header-admin.php');
        include_once('instances/navbar-admin.php');
        include_once('pages/editUser.php');
        include_once('instances/footer-admin.php');
        break;
        
    //
    //
    //
    case "banned":
        include_once('pages/banned.php');
        break;
    case "activate":
        include_once('pages/activate.php');
        break;
    case "login":
        include_once('pages/login.php');
        break;
    case "register":
        include_once('pages/register.php');
        break;
    case "logout":
        unset($_SESSION["USER:DATA"]);
        unset($_SESSION["USER:LOGGED"]);
        break;
}
?>
