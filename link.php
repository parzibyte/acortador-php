<?php

use Parzibyte\LinkController;
use Parzibyte\StatisticsController;

include_once "vendor/autoload.php";

if (!isset($_GET["hash"])) {
    exit("id is not present in URL");
}
$hash = $_GET["hash"];
$link = LinkController::getOneByHash($hash);
if (!$link) {
    exit("Link does not exist");
}
StatisticsController::registerClick($link->id);
if ($link->instant_redirect) {
    header("Location: " . $link->real_link);
    exit;
} else {
    include_once "redirect_template.php";
}
