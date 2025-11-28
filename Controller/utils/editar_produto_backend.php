<?php
// include 'gerar_notificacao.php';
include '../../model/DB/conexao.php';

$popup_titulo = '';
$popup_mensagem = '';
$popup_tipo = '';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../adm/catalogo_produtos.php');
    exit;
}

$id_produto   = (int)($_POST['id_produto'] ?? 0);
$nome         = trim($_POST['nome'] ?? '');
$valor        = floatval($_POST['valor'] ?? 0);
$quantidade   = intval($_POST['quantidade'] ?? 0);
$descricao    = trim($_POST['descricao'] ?? '');
$sexo         = $_POST['sexo'] ?? '';
$peso         = floatval($_POST['peso'] ?? 0);
$idade        = $_POST['idade'] ?? null;
$campeao      = (isset($_POST['campeao']) && strtolower($_POST['campeao']) === 'sim') ? 1 : 0;
$categoria    = intval($_POST['categoria'] ?? 0);
$subcategoria = intval($_POST['subcategoria'] ?? 0);
if ($id_produto <= 0 || empty($nome) || $valor <= 0 || $quantidade < 0 || $categoria <= 0 || $subcategoria <= 0) {
    $popup_titulo = "Erro!";
    $popup_mensagem = "Preencha todos os campos obrigatórios corretamente.";
    $popup_tipo = "erro";
} else {
    $sql = "SELECT path_img FROM produto WHERE id_produto = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $id_produto);
    $stmt->execute();
    $stmt->bind_result($path_img_db);
    $stmt->fetch();
    $stmt->close();

    // // criar notificação inicio
    // $sql = "SELECT quant_estoque,prod_nome,path_img FROM produto WHERE id_produto = $id_produto";
    // $qtd_inicial = $con->query($sql);

    // $sql_encontrar_cliente = "SELECT id_cliente FROM carrinho WHERE id_produto = $id_produto";
    // $qtd_cliente = $con->query($sql_encontrar_cliente);
    // $clientes = [];

    // if ($qtd_cliente && $qtd_cliente->num_rows > 0) {
    //     while ($cliente_row = $qtd_cliente->fetch_assoc()) {
    //         $clientes[] = $cliente_row['id_cliente'];
    //     }
    // }

    // if ($qtd_inicial && $qtd_inicial->num_rows > 0) {
    //     $row = $qtd_inicial->fetch_assoc();
    //     $quant_estoque_inicial = $row['quant_estoque'];
    //     $img_produto = $row['path_img'];
    //     $nome_produto = $row['prod_nome'];
    // }

    // if ($quant_estoque_inicial == 0 && $quantidade > 0) {
    //     foreach ($clientes as $x) {
    //         $usuario_id = $x;
    //         $produto_id = $id_produto;
    //         $mensagem = "Cliente, a {$nome_produto} que você estava de olho voltou ao estoque, dê uma olhada!";
    //         $categoria = "Produtos";
    //         if (Criar_notificacao($con, $usuario_id, $produto_id, $mensagem, $categoria)) {
    //             echo "Notificação enviada com sucesso!";
    //         } else {
    //             echo "Erro ao enviar notificação.";
    //         }
    //     }
    // }
    // // criar notificação fim

    $old_imgs = json_decode($path_img_db, true);
    if (!is_array($old_imgs))
        $old_imgs = [null, null, null, null];
    while (count($old_imgs) < 4)
        $old_imgs[] = null;
    $pastaUpload = '../../view/public/uploads/';
    if (!is_dir($pastaUpload))
        mkdir($pastaUpload, 0777, true);

    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $maxSize = 5 * 1024 * 1024;

    $final_imgs = $old_imgs;
    $remove_flags = $_POST['remove_img'] ?? [];
    if (isset($_FILES['imagens']) && is_array($_FILES['imagens']['name'])) {
        for ($i = 0; $i < 4; $i++) {
            $wasRemoved = isset($remove_flags[$i]) && ($remove_flags[$i] == '1' || $remove_flags[$i] === 1);
            $fileError = $_FILES['imagens']['error'][$i] ?? UPLOAD_ERR_NO_FILE;
            if ($fileError === UPLOAD_ERR_OK && !empty($_FILES['imagens']['name'][$i])) {
                $tmp = $_FILES['imagens']['tmp_name'][$i];
                $orig = $_FILES['imagens']['name'][$i];
                $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));
                $size = $_FILES['imagens']['size'][$i];

                if (in_array($ext, $allowed) && $size <= $maxSize) {
                    $novo = "img" . ($i + 1) . "_" . time() . "_" . uniqid() . "." . $ext;
                    $destino = $pastaUpload . $novo;
                    if (move_uploaded_file($tmp, $destino)) {
                        if (!empty($old_imgs[$i]) && file_exists('../../view/public/' . $old_imgs[$i])) {
                            @unlink('../../view/public/' . $old_imgs[$i]);
                        }
                        $final_imgs[$i] = 'uploads/' . $novo;
                        continue;
                    }
                }
            } elseif ($wasRemoved) {
                if (!empty($old_imgs[$i]) && file_exists('../../view/public/' . $old_imgs[$i])) {
                    @unlink('../../view/public/' . $old_imgs[$i]);
                }
                $final_imgs[$i] = null;
            } else {
            }
        }
    } else {
        for ($i = 0; $i < 4; $i++) {
            $wasRemoved = isset($remove_flags[$i]) && ($remove_flags[$i] == '1' || $remove_flags[$i] === 1);
            if ($wasRemoved) {
                if (!empty($old_imgs[$i]) && file_exists('../../view/public/' . $old_imgs[$i])) {
                    @unlink('../../view/public/' . $old_imgs[$i]);
                }
                $final_imgs[$i] = null;
            }
        }
    }

    while (count($final_imgs) < 4)
        $final_imgs[] = null;
    $hasImage = false;
    foreach ($final_imgs as $f) {
        if (!empty($f)) {
            $hasImage = true;
            break;
        }
    }
    if (!$hasImage) {
        $popup_titulo = "Imagem obrigatória!";
        $popup_mensagem = "O produto deve possuir ao menos uma imagem.";
        $popup_tipo = "erro";
    } else {
        $path_json = json_encode($final_imgs, JSON_UNESCAPED_UNICODE);

        $sqlUp = "UPDATE produto SET
            prod_nome = ?,
            valor = ?,
            quant_estoque = ?,
            path_img = ?,
            descricao = ?,
            sexo = ?,
            peso = ?,
            idade = ?,
            campeao = ?,
            id_categoria = ?,
            id_subcategoria = ?
            WHERE id_produto = ?";

        $stmt2 = $con->prepare($sqlUp);
        if (!$stmt2) {
            $popup_titulo = "Erro no banco!";
            $popup_mensagem = "Prepare falhou: " . $con->error;
            $popup_tipo = "erro";
        } else {
            $idadeParam = $idade !== '' ? $idade : null;
            $stmt2->bind_param(
                "sdisssdsiiii",
                $nome,
                $valor,
                $quantidade,
                $path_json,
                $descricao,
                $sexo,
                $peso,
                $idadeParam,
                $campeao,
                $categoria,
                $subcategoria,
                $id_produto
            );

            if ($stmt2->execute()) {
                $popup_titulo = "Produto atualizado!";
                $popup_mensagem = "As alterações foram salvas com sucesso.";
                $popup_tipo = "sucesso";
            } else {
                $popup_titulo = "Erro ao atualizar!";
                $popup_mensagem = "Não foi possível salvar as alterações: " . $stmt2->error;
                $popup_tipo = "erro";
            }
            $stmt2->close();
        }
    }
}
?>
<?php if (!empty($popup_titulo)): ?>
    <div id="popup_resultado" class="popup_resultado" style="display:flex;">
        <div class="area_popup_resultado <?= $popup_tipo ?>">
            <span class="fechar_popup_resultado">&times;</span>
            <h2><?= htmlspecialchars($popup_titulo, ENT_QUOTES, 'UTF-8') ?></h2>
            <p><?= nl2br(htmlspecialchars($popup_mensagem, ENT_QUOTES, 'UTF-8')) ?></p>
            <div class="botoes_popup_resultado">
                <button onclick="location.href='../adm/catalogo_produtos.php'"
                    class="botao_popup_cancelar fechar_popup_resultado">Fechar</button>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="../../view/public/css/cliente/pop_up_resultado.css">
<script src="../../view/public/js/pop_up_resultado.js"></script>
<?php endif; ?>
