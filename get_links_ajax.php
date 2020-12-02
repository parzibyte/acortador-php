<?php

use Parzibyte\LinkController;

include_once "session_check.php";
include_once "vendor/autoload.php";

if (isset($_GET["search"]) && !empty($_GET["search"])) {
    echo json_encode(LinkController::search($_GET["search"]));
} else {
    echo json_encode(LinkController::getAll());
}
