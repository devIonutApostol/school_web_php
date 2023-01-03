<?php include("top-guard.php") ?>

<?php
if (!isset($_SESSION['type']) || $_SESSION["type"] != 0) {
    session_destroy();
    header("Location: index.php");
    exit;
}
include('articles-repo.php');
?>

<h1>Reader</h1>


<?php include("bottom.php") ?>