<?php
session_start();

if (isset($_SESSION['id_adm'])) {
    $_SESSION = array();
    session_destroy();
}

header("Location: login.php");
exit();
?>