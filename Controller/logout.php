<?php

session_start();

$_SESSION = array();

session_destroy();

header("Location: ../controller/cliente/login.php");

exit;
?>
