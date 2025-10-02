<?php 
session_start(); 

include 'menu_pg_inicial.php';
include '../../model/DB/conexao.php';

if (!isset($_SESSION['id_cliente'])) {
    die( include '../overlays/pop_up_login.php');
}

$id_cliente = $_SESSION['id_cliente'];

$sql = "SELECT tipo, mensagemtexto, data_recebida 
        FROM notificacoes 
        WHERE id_cliente = ? 
        ORDER BY data_recebida DESC";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();

$notificacoes = [];
while ($row = $result->fetch_assoc()) {
    $notificacoes[] = $row;
}
$stmt->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificações</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
    integrity="sha512-9xKTRVabjVeZmc+GUW8GgSmcREDunMM+Dt/GrzchfN8tkwHizc5RP4Ok/MXFFy5rIjJjzhndFScTceq5e6GvVQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../view/public/css/adm/pg_notificacao.css">
</head>
<body>
    <div class="title_area_notifications">
        <div class="area_notifications">
            <a href="#" class="notification_arrow">
                <i class="bi bi-chevron-left"></i>
            </a>
            <h1 class="notification_title">Notificações</h1>
        </div>

        <div class="notification_area">
            <?php if (!empty($notificacoes)): ?>
                <?php foreach ($notificacoes as $n): ?>
                    <div class="notification">
                        <div class="notification_info">
                            <p class="notification_date">
                                <?= date("d/m/Y", strtotime($n["data_recebida"])) ?> - <?= htmlspecialchars($n["tipo"]) ?>
                            </p>
                            <p class="notification_text"><?= htmlspecialchars($n["mensagemtexto"]) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="notification_empty">
                    <p>Você não possui notificações no momento.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>
