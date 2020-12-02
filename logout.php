<?php

use Parzibyte\SessionController;

include_once "vendor/autoload.php";
SessionController::logout();
header("Location: login.php?logged-out");