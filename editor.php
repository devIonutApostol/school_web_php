<?php include("top-guard.php") ?>

<?php
if (!isset($_SESSION['type']) || $_SESSION["type"] != 2) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<h1>Editor</h1>

<?php include("bottom.php") ?>