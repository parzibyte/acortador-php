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
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $link->title ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
</head>

<body>
    <main class="container-fluid">
        <div class="row">
            <div class="col-12 text-center">
                <h2>Redireccionando a <?php echo $link->title ?>...</h2>
                <div class="alert alert-primary">
                    <h4>Para continuar, sígueme en una de mis redes sociales: (el enlace se muestra al hacer clic)</h4>
                </div>
                <a href="https://www.youtube.com/channel/UCroP4BTWjfM0CkGB6AFUoBg?sub_confirmation=1" target="_blank" class="seguir btn btn-danger mb-2">Youtube&nbsp;<i class="fab fa-youtube"></i></a>
                <a href="https://www.facebook.com/parzibyte.fanpage/" target="_blank" class="seguir btn btn-primary mb-2">Facebook&nbsp;<i class="fab fa-facebook"></i></a>
                <br>
                <a href="https://twitter.com/parzibyte" target="_blank" class="seguir btn btn-info">Twitter&nbsp;<i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/parzibyte/" target="_blank" class="seguir btn btn-warning">Instagram&nbsp;<i class="fab fa-instagram"></i></a>
            </div>
            <div class="col-12 mt-2 text-center" id="link"> </div>
            <div class="col-12 text-center">
                <div class="alert alert-success">
                    <h4>También puedes seguir a una web amiga:</h4>
                </div>
            </div>
            <div class="col-12">

                <ul class="list-group">
                    <li class="list-group-item">
                        <a class="seguir" target="_blank" href="https://parzibyte.me/l/f7yL3x">Arañita MX - Productos hechos a mano ✨</a>
                    </li>
                    <li class="list-group-item">
                        <a class="seguir" target="_blank" href="https://parzibyte.me#contacto">Quiero ver mi página aquí</a>
                    </li>
                </ul>
            </div>
        </div>
        <script>
            let mostrado = false;
            document.addEventListener("DOMContentLoaded", () => {
                const $link = document.querySelector("#link");
                const $buttons = document.querySelectorAll(".seguir");
                $buttons.forEach($button => {
                    $button.addEventListener("click", () => {
                        if (mostrado) return;
                        mostrado = true;
                        $link.innerHTML = `<strong class="h5">¡Gracias por seguirme, me motivas a seguir con mi trabajo!</strong><br>Redireccionando...`;
                        setTimeout(async () => {
                            (async () => {
                                await fetch("./track_link.php", {
                                    method: "POST",
                                    body: JSON.stringify("<?php echo $link->hash ?>"),
                                });
                                window.location.href = "<?php echo $link->real_link ?>";
                            })();
                        }, 1000)
                    })
                });
            });
        </script>

        <?php include_once "footer.php"; ?>