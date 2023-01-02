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

if (is_null($result)) {
    $database->insert("insert into users (username,password,type) values (?,?,0)", array(
        array(
            "param_type" => "s",
            "param_value" => $_POST['username']
        ),
        array(
            "param_type" => "s",
            "param_value" => password_hash($_POST['username'], PASSWORD_DEFAULT)
        )
    )
    );

    $_SESSION["info"] = 'User created';
    header("Location: login.php");
} else {
    $_SESSION["error"] = "User exists";
    header("Location: register.php");
}
?>