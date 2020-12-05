<?php
/*

  ____          _____               _ _           _       
 |  _ \        |  __ \             (_) |         | |      
 | |_) |_   _  | |__) |_ _ _ __ _____| |__  _   _| |_ ___ 
 |  _ <| | | | |  ___/ _` | '__|_  / | '_ \| | | | __/ _ \
 | |_) | |_| | | |  | (_| | |   / /| | |_) | |_| | ||  __/
 |____/ \__, | |_|   \__,_|_|  /___|_|_.__/ \__, |\__\___|
         __/ |                               __/ |        
        |___/                               |___/         
    
____________________________________
/ Si necesitas ayuda, contáctame en \
\ https://parzibyte.me               /
 ------------------------------------
        \   ^__^
         \  (oo)\_______
            (__)\       )\/\
                ||----w |
                ||     ||
Creado por Parzibyte (https://parzibyte.me).
------------------------------------------------------------------------------------------------
Si el código es útil para ti, puedes agradecerme siguiéndome: https://parzibyte.me/blog/sigueme/
Y compartiendo mi blog con tus amigos
También tengo canal de YouTube: https://www.youtube.com/channel/UCroP4BTWjfM0CkGB6AFUoBg?sub_confirmation=1
------------------------------------------------------------------------------------------------
*/ ?>
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
