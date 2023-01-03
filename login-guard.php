<?php
if (!isset($_SESSION['loggedin']) || $_SESSION["loggedin"] != true) {
    header("Location: login.php");
    exit;
}

if(array_key_exists('logout', $_POST)) {
    logout();
}

function logout()
{
    session_destroy();
    header("Location: login.php");
}
?>
<form method="post">
    <input type="submit" name="logout" class="btn btn-light" style="position: fixed; top: 5px; right: 20px;" value="Logout" />
</form>