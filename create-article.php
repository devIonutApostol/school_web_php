<?php
session_start();

include('database.php');
$database = new Database;


$database->insert(
    "insert into articles (title,category,content,created,authorid) values (?,?,?,?,?)",
    array(
        array(
            "param_type" => "s",
            "param_value" => $_POST['title']
        ),
        array(
            "param_type" => "s",
            "param_value" => $_POST['category']
        ),
        array(
            "param_type" => "s",
            "param_value" => $_POST['content']
        ),
        array(
            "param_type" => "s",
            "param_value" => date("Y-m-d")
        ),
        array(
            "param_type" => "i",
            "param_value" => $_SESSION['id']
        )
    )
);

$_SESSION["info"] = 'Article created';
header("Location: journalist.php");

?>