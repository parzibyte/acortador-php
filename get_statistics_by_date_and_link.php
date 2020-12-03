<?php

use Parzibyte\StatisticsController;

include_once "session_check.php";
include_once "vendor/autoload.php";

if (!isset($_GET["start"]) || !isset($_GET["end"]) || !isset($_GET["link_id"])) {
    exit("link_id, start and end are required");
}

$data = StatisticsController::getClickCountByDateAndLink($_GET["link_id"], $_GET["start"], $_GET["end"]);
echo json_encode($data);
