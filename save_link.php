<?php

use Parzibyte\LinkController;

include_once "session_check.php";
if (!isset($_POST["title"]) || !isset($_POST["real_link"])) {
    exit("title and real link are required");
}

include_once "vendor/autoload.php";
$instantRedirect = isset($_POST["instant_redirect"]);
LinkController::add($_POST["title"], $_POST["real_link"], $instantRedirect);
header("Location: link_management.php");
