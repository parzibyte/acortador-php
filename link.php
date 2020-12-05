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

use Parzibyte\LinkController;

include_once "vendor/autoload.php";

if (!isset($_GET["hash"])) {
    exit("id is not present in URL");
}
$hash = $_GET["hash"];
$link = LinkController::getOneByHash($hash);
if (!$link) {
    exit("Link does not exist");
}
if ($link->instant_redirect) {
?>
    <script>
        (async () => {
            await fetch("./track_link.php", {
                method: "POST",
                body: JSON.stringify("<?php echo $link->hash ?>"),
            });
            window.location.href = "<?php echo $link->real_link ?>";
        })();
    </script>
<?php
    exit;
} else {
    include_once "redirect_template.php";
}
