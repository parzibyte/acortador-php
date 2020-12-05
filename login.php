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
include_once "header.php";
?>
<div class="row">
    <div class="col-12 offset-md-4 col-md-4">
        <h2>Login</h2>
        <form action="do_login.php" method="POST">
            <div class="form-group">
                <label for="email">Email: </label>
                <input required id="email" name="email" type="email" placeholder="your@email.com" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input required id="password" name="password" type="password" placeholder="Password" class="form-control">
            </div>
            <?php if (isset($_GET["incorrect"])) { ?>
                <div class="alert alert-warning">
                    Password or email do not match
                </div>
            <?php } ?>
            <?php if (isset($_GET["login"])) { ?>
                <div class="alert alert-warning">
                    Please login
                </div>
            <?php } ?>

            <?php if (isset($_GET["logged-out"])) { ?>
                <div class="alert alert-info">
                    You've logged out. Come back soon :)
                </div>
            <?php } ?>
            <div class="form-group">
                <button class="btn btn-success">Login</button>
            </div>
        </form>
    </div>
</div>
<?php
include_once "footer.php";
