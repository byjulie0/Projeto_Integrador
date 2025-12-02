<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../adm/catalogo_produtos.php');
    exit;
}

// Valores vindos pelo formulario
$id_produto = (int) ($_POST['id_produto'] ?? 0);
$nome = trim($_POST['nome'] ?? '');
$valor = floatval($_POST['valor'] ?? 0);
$quantidade = intval($_POST['quantidade'] ?? 0);
$quant_estoque = intval($_POST['quant_estoque']);
$descricao = trim($_POST['descricao'] ?? '');
$sexo = $_POST['sexo'] ?? null; // modificado p/ null
$peso = floatval($_POST['peso'] ?? null); // modificado p/ null
$idade = $_POST['idade'] ?? null; // modificado p/ null
$campeao = (isset($_POST['campeao']) && strtolower($_POST['campeao']) === 'sim') ? 1 : 0;
$categoria = intval($_POST['categoria'] ?? 0);
$subcategoria = intval($_POST['subcategoria'] ?? 0);

if ($id_produto <= 0 || empty($nome) || $valor <= 0 || $quantidade < 0 || $categoria <= 0 || $subcategoria <= 0) {

    $_SESSION['titulo'] = "Há campos não preenchidos!";
    $_SESSION['popup_message'] = "Preencha todos os campos obrigatórios corretamente.";
    $_SESSION['type'] = 'error';

    header("Location: ../adm/editar_produto.php?id_produto=<?php echo $id_produto;?>");
    exit;

} else {
    $sql = "SELECT path_img FROM produto WHERE id_produto = ?";
    $query = $con->prepare($sql);
    $query->bind_param("i", $id_produto);
    $query->execute();
    $query->bind_result($path_img_db);
    $query->fetch();
    $query->close();

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
        $_SESSION['titulo'] = "Imagem obrigatória!";
        $_SESSION['popup_message'] = "O produto deve possuir ao menos uma imagem.";
        $_SESSION['type'] = 'error';

        header("Location: ../adm/editar_produto.php?id_produto=<?php echo $id_produto;?>");
        exit;

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

        $query = $con->prepare($sqlUp);
        if (!$query) {
            $_SESSION['titulo'] = "Erro no banco!";
            $_SESSION['popup_message'] = "Prepare falhou.";
            $_SESSION['type'] = 'error';

            header("Location: ../adm/catalogo_produtos.php");
            exit;

        } else {
            $idadeParam = $idade !== '' ? $idade : null;
            $query->bind_param(
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

            if ($query->execute()) {
                if ($quant_estoque == 0 && $quantidade >= 1) {
                    $sql = "UPDATE produto SET produto_ativo = 1 WHERE id_produto = ?";
                    $query2 = $con->prepare($sql);
                    $query2->bind_param("i", $id_produto);
                    $query2->execute();
                    $query2->close();
                }

                $query->close();
                $_SESSION['titulo'] = "Produto atualizado!";
                $_SESSION['popup_message'] = "As alterações foram salvas com sucesso.";
                $_SESSION['type'] = 'success';

                header("Location: ../adm/catalogo_produtos.php");
                exit;

            } else {

                $query->close();
                $_SESSION['titulo'] = "Erro ao atualizar!";
                $_SESSION['popup_message'] = "Não foi possível salvar as alterações";
                $_SESSION['type'] = 'error';
                
                header("Location: ../adm/editar_produto.php?id_produto=<?php echo $id_produto;?>");
                exit;
            }
        }
    }
}