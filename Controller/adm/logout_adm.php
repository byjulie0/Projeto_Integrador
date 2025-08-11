<?php

session_start();

$_SESSION = array();

session_destroy();

header("Location: /Projeto_Integrador/controller/adm/login_adm.php");

exit();
?>
