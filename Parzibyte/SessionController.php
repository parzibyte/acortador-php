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

class SessionController
{
    public static function get($key)
    {
        self::sessionStart();
        return $_SESSION[$key];
    }

    public static function logout()
    {
        self::sessionStart();
        session_destroy();
    }

    public static function redirectIfNotLoggedIn()
    {
        self::sessionStart();
        if (!isset($_SESSION["id"]) || !isset($_SESSION["email"])) {
            header("Location: login.php?login");
            exit;
        }
    }

    public static function propagateUser($id, $email)
    {
        self::sessionStart();
        $_SESSION["id"] = $id;
        $_SESSION["email"] = $email;
    }

    public static function sessionStart()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
            session_regenerate_id(true);
        }
    }
}
