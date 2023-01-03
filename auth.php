<?php
session_start();

include('database.php');
$database = new Database;

$result = $database->query(
    "select * from users where username = ?",
    array(
        array(
            "param_type" => "s",
            "param_value" => $_POST['username']
        )
    )
);

if(is_null($result) || !password_verify($_POST["password"], $result[0]["password"]))
{
    $_SESSION["error"] = "Invalid password or user does not exists";
    header("Location: login.php");
}
else
{
    $_SESSION['loggedin'] = true;
    $_SESSION['name'] = $_POST['username'];
    $_SESSION['id'] = $result[0]["id"];
    $_SESSION['type'] = $result[0]['type'];

    header("Location: index.php");
}


?>