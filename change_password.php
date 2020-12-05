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
if (!isset($_GET["id"])) {
    exit("id is required");
}

$user = UserController::getOneById($_GET["id"]);
if (!$user) {
    exit("User does not exist");
}

include_once "header.php";
include_once "nav.php";
?>
<div class="row">
    <div class="col-12">
        <h2>Change password for <?php echo $user->email ?></h2>
        <form action="update_password.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $user->id ?>">
            <div class="form-group">
                <label for="current_password">Current password:</label>
                <input required autocomplete="current-password" class="form-control" id="current_password" type="password" name="current_password" placeholder="Current password">
            </div>
            <div class="form-group">
                <label for="new_password">New password:</label>
                <input required autocomplete="new-password" class="form-control" id="new_password" type="password" name="new_password" placeholder="New password">
            </div>
            <div class="form-group">
                <label for="new_password_confirm">Confirm new password:</label>
                <input required autocomplete="new-password" class="form-control" id="new_password_confirm" type="password" name="new_password_confirm" placeholder="Confirm new password">
            </div>
            <?php if (isset($_GET["new_password_do_not_match"])) { ?>
                <div class="alert alert-warning">
                    New password and confirm new password do not match
                </div>
            <?php } ?>

            <?php if (isset($_GET["current_password_do_not_match"])) { ?>
                <div class="alert alert-warning">
                    Current password do not match
                </div>
            <?php } ?>
            <?php if (isset($_GET["password_changed"])) { ?>
                <div class="alert alert-success">
                    Password changed successfully
                </div>
            <?php } ?>
            <button class="btn btn-success">Change</button>
        </form>
    </div>
</div>
<?php
include_once "footer.php";
?>