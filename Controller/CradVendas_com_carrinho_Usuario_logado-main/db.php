<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "loja";
$port = 3306;

$mysqli = new mysqli($host, $user, $pass, $dbname, $port);

if ($mysqli->connect_error) {
    die("Erro na conexão: " . $mysqli->connect_error);
}

else{
    echo "conectado";
}
?>