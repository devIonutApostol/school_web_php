<?php
if (isset($_SESSION["error"])) {
    echo sprintf('<div class="alert alert-danger" role="alert"> %s </div>', $_SESSION["error"]);
    $_SESSION["error"] = null;
}

if (isset($_SESSION["info"])) {
    echo sprintf('<div class="alert alert-success" role="alert"> %s </div>', $_SESSION["info"]);
    $_SESSION["info"] = null;
}

?>