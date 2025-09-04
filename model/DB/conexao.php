<?php
$host= "192.168.22.9";
// $host= "localhost";
$usuario = "turma143p1";
// $usuario = "root";
$senha = "sucesso@143";
// $senha = "";
$bd = "143p1";


$con = new mysqli($host, $usuario, $senha, $bd);


if ($con -> connect_errno){
echo "Falha na Conexão: (".$con->connect_errno.")".$con-> connect_error;
}


else{
echo "Conectado:" . $con->host_info . "\n";
}

?>