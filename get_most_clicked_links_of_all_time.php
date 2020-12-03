<?php

use Parzibyte\StatisticsController;

include_once "session_check.php";
include_once "vendor/autoload.php";
$data = StatisticsController::getMostClickedLinksOfAllTime();
echo json_encode($data);
