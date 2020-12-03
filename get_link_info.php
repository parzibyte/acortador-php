<?php

use Parzibyte\LinkController;

include_once "session_check.php";
include_once "vendor/autoload.php";

if (!isset($_GET["link_id"])) {
    exit("link_id is required");
}
echo json_encode(LinkController::getOne($_GET["link_id"]));
