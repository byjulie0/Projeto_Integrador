<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../../model/DB/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../adm/relatorios_visualizar.php');
    exit;
}

// Valores vindos pelo formulario
$nome = trim($_POST['nome'] ?? '');
$valor = floatval($_POST['valor'] ?? 0);
$quantidade = intval($_POST['quantidade'] ?? 0);
$descricao = trim($_POST['descricao'] ?? '');
$sexo = $_POST['sexo'] ?? null; // null
$peso = floatval($_POST['peso'] ?? null); // null
$idade = $_POST['idade'] ?? null; // null
$campeao = strtolower($_POST['campeao'] ?? '') === 'sim' ? 1 : 0;
$categoria = intval($_POST['categoria'] ?? 0);
$subcategoria = intval($_POST['subcategoria'] ?? 0);

if (empty($nome) || $valor <= 0 || $quantidade < 0 || $categoria <= 0 || $subcategoria <= 0 || empty($sexo)) {
    $_SESSION['titulo'] = "Erro!";
    $_SESSION['popup_message'] = "Preencha todos os campos obrigatórios corretamente."; // CORRIGIDO: mensage → message
    $_SESSION['type'] = "error";

    header("Location: ../adm/adicionar_produto.php");
    exit;
} else {

    $pastaUpload = '../../view/public/uploads/';
    if (!is_dir($pastaUpload))
        mkdir($pastaUpload, 0777, true);

    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $imagens_nomes = array_fill(0, 4, null);
    $uploadOk = false;

    if (isset($_FILES['imagens']) && is_array($_FILES['imagens']['name'])) {
        for ($i = 0; $i < 4; $i++) {
            if (
                isset($_FILES['imagens']['error'][$i]) &&
                $_FILES['imagens']['error'][$i] === UPLOAD_ERR_OK &&
                !empty($_FILES['imagens']['name'][$i])
            ) {
                $file_tmp = $_FILES['imagens']['tmp_name'][$i];
                $file_name = $_FILES['imagens']['name'][$i];
                $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

                if (in_array($ext, $allowed) && $_FILES['imagens']['size'][$i] <= 5 * 1024 * 1024) {
                    $novo_nome = "img" . ($i + 1) . "_" . time() . ".$ext";
                    $destino = $pastaUpload . $novo_nome;

                    if (move_uploaded_file($file_tmp, $destino)) {
                        $imagens_nomes[$i] = 'uploads/' . $novo_nome;
                        $uploadOk = true;
                    }
                }
            }
        }
    }

    if (!$uploadOk) {
        $_SESSION['titulo'] = "Imagem obrigatória!";
        $_SESSION['popup_message'] = "Adicione pelo menos uma imagem, tipos de imagem aceitos: 'jpg', 'jpeg', 'png', 'gif', 'webp'."; // CORRIGIDO: mensage → message
        $_SESSION['type'] = "error";

        header("Location: ../adm/adicionar_produto.php");
        exit;
    } else {
        $imagens_json = json_encode($imagens_nomes, JSON_UNESCAPED_UNICODE);

        $query = $con->prepare("INSERT INTO produto
                (prod_nome, valor, quant_estoque, path_img, descricao, sexo, peso, idade, campeao, id_categoria, id_subcategoria)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $query->bind_param(
            "sdisssdsiii",
            $nome,
            $valor,
            $quantidade,
            $imagens_json,
            $descricao,
            $sexo,
            $peso,
            $idade,
            $campeao,
            $categoria,
            $subcategoria
        );

        if ($query->execute()) {

            $query->close();
            $_SESSION['titulo'] = "Sucesso!";
            $_SESSION['popup_message'] = $nome . " foi cadastrado com sucesso!"; // CORRIGIDO: mensage → message
            $_SESSION['type'] = "success";

            header("Location: ../adm/catalogo_produtos.php");
            exit;
        } else {

            $query->close();
            $_SESSION['titulo'] = "Não foi possivel cadastrar produto!";
            $_SESSION['popup_message'] = "Erro: " . $query->error; // CORRIGIDO: mensage → message
            $_SESSION['type'] = "error";

            header("Location: ../adm/adicionar_produto.php");
            exit;
        }
    }
}
?>