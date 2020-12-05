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

include_once "session_check.php";
if (!isset($_GET["id"])) exit("id is required");
include_once "vendor/autoload.php";
$link = LinkController::getOne($_GET["id"]);
if (!$link) {
    exit("Link does not exist");
}
include_once "header.php";
include_once "nav.php";
?>
<div class="row">
    <div class="col-12">
        <h1>New link</h1>
        <form action="update_link.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $link->id ?>">
            <div class="form-group">
                <label for="title">Title:</label>
                <input value="<?php echo $link->title ?>" required class="form-control" type="text" placeholder="Title" name="title" id="title">
            </div>
            <div class="form-group">
                <label for="real_link">Real link:</label>
                <input value="<?php echo $link->real_link ?>" required class="form-control" type="text" placeholder="Real link" name="real_link" id="real_link">
            </div>
            <div class="form-group">
                <label for="instant_redirect">Instant redirect <i title="Make instant redirect or show user template before redirect" class="fa fa-question-circle"></i></label>
                <input <?php echo $link->instant_redirect ? 'checked' : '' ?> type="checkbox" name="instant_redirect" id="instant_redirect">
            </div>
            <div class="form-group">
                <button class="btn btn-success">Save</button>
            </div>
        </form>
    </div>
</div>
<?php
include_once "footer.php";
?>