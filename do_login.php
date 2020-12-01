<?php

use Parzibyte\SessionController;
use Parzibyte\UserController;

if (!isset($_POST["email"]) || !isset($_POST["password"])) {
    exit("email and password are required");
}
include_once "vendor/autoload.php";
$ok = UserController::auth($_POST["email"], $_POST["password"]);

if ($ok) {
    $user = UserController::getOneByEmail($_POST["email"]);
    SessionController::propagateUser($user->id, $user->email);
    header("Location: link_management.php");
} else {
    header("Location: login.php?incorrect");
}
