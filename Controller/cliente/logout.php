<?php

session_start();

$_SESSION = array();

session_destroy();

header("Location: /Projeto_Integrador/controller/cliente/login.php");

exit();
?>
