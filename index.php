<?php include("top.php") ?>


<?php


switch($_SESSION['type'])
{
    case 1:
        header("Location: journalist.php");
        break;
    case 2:
        header("Location: editor.php");
        break;
}

?>


<?php include("bottom.php") ?>