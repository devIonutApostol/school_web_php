<?php include("top.php") ?>


<?php


switch($_SESSION['type'])
{
    case 0:
        header("Location: reader.php");
        break;
    case 1:
        header("Location: journalist.php");
        break;
    case 2:
        header("Location: editor.php");
        break;
}

?>


<?php include("bottom.php") ?>