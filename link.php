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
