<?php
session_start();
if(!$_SESSION['NOME']){
    header('location:pg_inicial_cliente.php');
    exit();
}?>