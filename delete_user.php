<?php

use Parzibyte\UserController;

include_once "session_check.php";
include_once "vendor/autoload.php";
if (!isset($_GET["id"])) {
    exit("id is required");
}
UserController::delete($_GET["id"]);
header("Location: users.php");
