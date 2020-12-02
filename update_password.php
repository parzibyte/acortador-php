<?php

use Parzibyte\Security;
use Parzibyte\UserController;

include_once "session_check.php";
include_once "vendor/autoload.php";
if (
    !isset($_POST["id"])
    ||
    !isset($_POST["current_password"])
    ||
    !isset($_POST["new_password"])
    ||
    !isset($_POST["new_password_confirm"])
) {
    exit("id, current_password, new_password and new_password_confirm are required");
}
$id = $_POST["id"];
$currentPassword = $_POST["current_password"];
$newPassword = $_POST["new_password"];
$confirmNewPassword = $_POST["new_password_confirm"];
if ($newPassword !== $confirmNewPassword) {
    header(sprintf("Location: change_password.php?id=%s&new_password_do_not_match", $id));
    exit;
}

if (!UserController::authById($id, $currentPassword)) {
    header(sprintf("Location: change_password.php?id=%s&current_password_do_not_match", $id));
    exit;
}

UserController::updatePassword($id, $newPassword);

header(sprintf("Location: change_password.php?id=%s&password_changed", $id));
