<?php
ob_start(); // Impede qualquer saída de texto

$host= "192.168.22.9";
$usuario = "turma143p1";
$senha = "sucesso@143";
$bd = "143p1";

$mysqldumpPath = "C:\\xampp\\mysql\\bin\\mysqldump.exe";

$backupFile = __DIR__ . '\\backup_' . $bd . '_' . date('Y-m-d_H-i-s') . '.sql';

$command = "{$mysqldumpPath} -h {$host} -u {$usuario} -p{$senha} --single-transaction {$bd} > \"{$backupFile}\" 2>&1";

exec($command, $output, $return);

// Se quiser, pode salvar logs em arquivo (mas sem mostrar nada ao usuário)
// file_put_contents(__DIR__ . '/log_backup.txt', implode("\n", $output));

ob_end_clean(); // Remove qualquer eco/print que tenha ocorrido

// Redirecionar de volta para o painel do ADM
header("Location: ../../controller/adm/relatorios_visualizar.php");
exit;
