<?php
session_start();
if (!isset($_SESSION['id_adm']) || $_SESSION['tipo_usuario'] !== 'ADM') {
    header("Location: ../../Controller/adm/login.php"); 
    exit();
}
?>