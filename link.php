<?php

include_once "vendor/autoload.php";


if (!isset($_GET["id"])) {
    exit("id is not present in URL");
}
$id = $_GET["id"];
var_dump($id);