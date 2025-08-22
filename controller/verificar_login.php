<?php
// session_start();
// include("verificacao.php");
// 
}?>
<!-- PAGINA ADMIN -->
<!-- <a href="logout.php">Sair</a> -->

<?php
session_start();
if(!$_SESSION['NOME']){
    header('location:pg_inicial_cliente.php');
    exit();
}?>