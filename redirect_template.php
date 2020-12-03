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
                <a href="https://parzibyte.me" target="_blank" class="seguir btn btn-danger mb-2">Youtube&nbsp;<i class="fab fa-youtube"></i></a>
                <a href="https://parzibyte.me" target="_blank" class="seguir btn btn-primary mb-2">Facebook&nbsp;<i class="fab fa-facebook"></i></a>
                <br>
                <a href="https://parzibyte.me" target="_blank" class="seguir btn btn-info">Twitter&nbsp;<i class="fab fa-twitter"></i></a>
                <a href="https://parzibyte.me" target="_blank" class="seguir btn btn-warning">Instagram&nbsp;<i class="fab fa-instagram"></i></a>
            </div>
            <div class="col-12 mt-2 text-center" id="link"> </div>
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
                        setTimeout(() => {
                            window.location.href = "<?php echo $link->real_link ?>";
                        }, 1000)
                    })
                });
            });
        </script>

        <?php include_once "footer.php"; ?>