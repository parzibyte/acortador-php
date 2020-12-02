<?php

use Parzibyte\LinkController;

include_once "session_check.php";
if (!isset($_GET["id"])) exit("id is required");
include_once "vendor/autoload.php";
LinkController::delete($_GET["id"]);
header("Location: link_management.php");
