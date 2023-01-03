<?php include("top.php") ?>


<?php


switch($_SESSION['type'])
{
    case 1:
        header("Location: journalist.php");
        break;
}

?>


<?php include("bottom.php") ?>