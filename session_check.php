<?php

use Parzibyte\SessionController;

include_once "vendor/autoload.php";
SessionController::redirectIfNotLoggedIn();
