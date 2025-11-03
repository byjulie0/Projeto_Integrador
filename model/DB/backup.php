<?php
$host = "127.0.0.1";  // Ou "localhost"
$usuario = "root";  // Usuário MySQL
$senha = "";  // Senha do MySQL, deixe vazio se não houver senha
$bd = "teste";  // Nome do banco de dados

// Caminho completo para o mysqldump.exe (ajuste conforme o local no seu sistema)
$mysqldumpPath = "C:\\xampp\\mysql\\bin\\mysqldump.exe";  // Caminho completo no XAMPP

// Gerando o nome do arquivo de backup
$backupFile = __DIR__ . '\\backup_' . $bd . '_' . date('Y-m-d_H-i-s') . '.sql';

// Comando mysqldump
$command = "{$mysqldumpPath} -h {$host} -u {$usuario} --single-transaction {$bd} > {$backupFile} 2>&1";

// Exibir o comando para depuração
echo "Comando executado: " . $command . "<br>";

// Executando o comando e capturando a saída e erro
exec($command, $output, $return);

// Exibindo erro completo e o código de retorno
echo "Código de retorno: " . $return . "<br>";
if ($return !== 0) {
    echo "Database backup failed. Error: " . implode("\n", $output) . "<br>";
} else {
    echo "Backup realizado com sucesso: " . $backupFile . "<br>";
}
?>
