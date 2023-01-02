<?php include("top.php") ?>


<?php

if(!isset($_SESSION['loggedin']) || $_SESSION["loggedin"] != true){
    header("Location: login.php");
}
else
{
    echo 'welcome';
}
?>


<?php include("bottom.php") ?>