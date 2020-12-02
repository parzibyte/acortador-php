<?php

use Parzibyte\UserController;

include_once "session_check.php";
include_once "vendor/autoload.php";
if (!isset($_POST["email"]) || !isset($_POST["password"]) || !isset($_POST["confirm_password"])) {
    exit("email, password and confirm_password are required");
}
$email = $_POST["email"];
$password = $_POST["password"];
$confirmPassword = $_POST["confirm_password"];
if (UserController::getOneByEmail($email)) {
    header("Location: add_user.php?existing_email");
    exit;
}
if ($password !== $confirmPassword) {
    header("Location: add_user.php?new_password_do_not_match");
    exit;
}
UserController::create($email, $password);
header("Location: users.php");
