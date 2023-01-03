<?php
session_start();

include('database.php');
$database = new Database;

$result = $database->query(
    "select id from users where username = ?",
    array(
        array(
            "param_type" => "s",
            "param_value" => $_POST['username']
        )
    )
);

$type = 0;

if(isset($_POST['type']))
{
    $type = $_POST['type'];
}

if (is_null($result)) {
    $database->insert("insert into users (username,password,type) values (?,?,?)", array(
        array(
            "param_type" => "s",
            "param_value" => $_POST['username']
        ),
        array(
            "param_type" => "s",
            "param_value" => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ),
        array(
            "param_type" => "i",
            "param_value" => $type
        ),
    )
    );

    $_SESSION["info"] = 'User created';
    header("Location: login.php");
} else {
    $_SESSION["error"] = "User exists";
    header("Location: register.php");
}
?>