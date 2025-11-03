<?php
$host= "192.168.22.9";
// $host= "localhost";
$usuario = "turma143p1";
// $usuario = "root";
$senha = "sucesso@143";
// $senha = "";
$bd = "143p1";

$backupFile = 'backup' . $bd . '_' . date('Y-m-d_H-i-s') . '.sql';

$command = "mysqldump -h {$bd} -u {$usuario} -p{$senha} --single-transaction {$bd} > {$backupFile}";

// Execute the command
exec($command, $output, $return);

if ($return === 0) {
    echo "Database backup successful to: " . $backupFile;
} else {
    echo "Database backup failed. Error: " . implode("\n", $output);
}
?>
