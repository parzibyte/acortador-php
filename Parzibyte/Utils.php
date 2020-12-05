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

namespace Parzibyte;

use Exception;

class Utils
{

    static function getVarFromEnvironmentVariables($key)
    {
        if (defined("_ENV_CACHE")) {
            $vars = _ENV_CACHE;
        } else {
            $file = "env.php";
            if (!file_exists($file)) {
                throw new Exception("The environment file ($file) does not exists. Please create it");
            }
            $vars = parse_ini_file($file);
            define("_ENV_CACHE", $vars);
        }
        if (isset($vars[$key])) {
            return $vars[$key];
        } else {
            throw new Exception("The specified key (" . $key . ") does not exist in the environment file");
        }
    }


}
