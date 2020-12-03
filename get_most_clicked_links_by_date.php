<?php

use Parzibyte\StatisticsController;

include_once "session_check.php";
include_once "vendor/autoload.php";

if (!isset($_GET["start"]) || !isset($_GET["end"])) {
    exit("start and end are required");
}

$data = StatisticsController::getMostClickedLinksByDate($_GET["start"], $_GET["end"]);
echo json_encode($data);

