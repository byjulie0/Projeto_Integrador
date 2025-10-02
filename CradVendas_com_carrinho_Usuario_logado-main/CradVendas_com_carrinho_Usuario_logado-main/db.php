<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "loja";
$port = 3310;

$mysqli = new mysqli($host, $user, $pass, $dbname, $port);

if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

else{
    echo "conectado";
}
?>