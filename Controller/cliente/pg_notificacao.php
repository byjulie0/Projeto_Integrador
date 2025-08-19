<?php
include 'menu_pg_inicial.php';
include '../../model\DB/conexao.php';
session_start();

// PEGAR ID DO CLIENTE LOGADO
$id_cliente = $_SESSION['id_cliente'] ?? null;

if (!$id_cliente) {
    // Se não estiver logado, redireciona para login
    header("Location: login.php");
    exit;
}

/* ========== (3) MARCAR COMO LIDA ========== */
$update = "UPDATE notificacao SET lida = 1 WHERE id_cliente = ?";
$stmt = $conn->prepare($update);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();

/* ========== (2) EXIBIR NOTIFICAÇÕES ========== */
$sql = "SELECT * FROM notificacao WHERE id_cliente = ? ORDER BY data_envio DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_cliente);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../view/public/css/cliente/pg_notificacao.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Notificações</title>
    <style>
        .notification { 
            padding: 10px; 
            border-bottom: 1px solid #ddd; 
        }
        .notification.lida { 
            background-color: #f0f0f0; 
        }
        .notification_area { 
            margin-top: 15px; 
        }
        .badge {
            background: red;
            color: white;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 50%;
            position: relative;
            top: -10px;
            left: -5px;
        }
    </style>
</head>

<body>
    <div class="title_area_notifications">
        <div class="area_notifications">
            <a href="#" onclick="if (document.referrer) { history.back(); } else { window.location.href = 'menu_pg_inicial.php'; }" class="notification_arrow">
                <i class="fa-solid fa-chevron-left" style="color: #2d8c37;"></i>
            </a>
            <h1 class="notification_title">Notificações</h1>
        </div>
        <div class="notification_area">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="notification <?= $row['lida'] ? 'lida' : '' ?>">
                        <div class="notification_info">
                            <p class="notification_date">
                                <?= date("d/m/Y H:i", strtotime($row['data_envio'])) ?> - <?= htmlspecialchars($row['titulo']) ?>
                            </p>
                            <p class="notification_text">
                                <?= htmlspecialchars($row['mensagem']) ?>
                            </p>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>📭 Você não tem notificações ainda.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
<?php
include 'footer_cliente.php';
?>
