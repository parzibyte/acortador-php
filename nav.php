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
*/

use Parzibyte\SessionController;

?>
<nav class="navbar navbar-expand-md navbar-dark bg-success fixed-top">
    <a class="navbar-brand" href="https://parzibyte.me/blog">
        <img class="img-fluid" style="max-height: 50px" src="img/parzibyte_logo.png" loading="lazy">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" id="botonMenu" aria-label="Mostrar u ocultar menú">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="link_management.php">Link management&nbsp;<i class="fa fa-link"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="statistics.php">Statistics&nbsp;<i class="fa fa-chart-bar"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">Users&nbsp;<i class="fa fa-users"></i></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="//parzibyte.me/blog">Support & help&nbsp;<i class="fa fa-hands-helping"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout (<?php
                                                                include_once "vendor/autoload.php";
                                                                echo SessionController::get("email");
                                                                ?>)&nbsp;<i class="fa fa-sign-out-alt"></i></a>
            </li>
        </ul>

    </div>
</nav>