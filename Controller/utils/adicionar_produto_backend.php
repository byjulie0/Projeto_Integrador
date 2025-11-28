<?php
session_start();
include '../../model/DB/conexao.php';

function mensagemErro($codigo) {
    $erros = [
        "nome_vazio"            => "O nome do produto não pode ficar vazio.",
        "valor_invalido"        => "O valor precisa ser maior que zero.",
        "quantidade_invalida"   => "A quantidade deve ser zero ou maior.",
        "categoria_invalida"    => "Selecione uma categoria válida.",
        "subcategoria_invalida" => "Selecione uma subcategoria válida.",
        "descricao_vazia"       => "A descrição é obrigatória.",

        // ANIMAIS
        "sexo_vazio"            => "Selecione o sexo do animal.",
        "peso_invalido"         => "Informe o peso corretamente.",
        "idade_invalida"        => "Informe a idade do animal.",
        "campeao_indefinido"    => "Selecione se o animal é campeão.",

        // IMAGENS
        "sem_imagem"            => "Envie pelo menos uma imagem.",
        "img_formato"           => "Formato inválido! Permitido: JPG, JPEG, PNG, GIF, WEBP.",
        "img_tamanho"           => "Cada imagem deve ter até 5MB.",
        "img_falha_upload"      => "Erro ao salvar a imagem. Tente novamente.",

        // BANCO
        "banco_erro"            => "Erro ao salvar no banco.",
        "banco_conexao"         => "Falha de conexão com o banco.",

        // GERAL
        "dados_incompletos"     => "Preencha todos os campos obrigatórios.",
        "erro_desconhecido"     => "Ocorreu um erro inesperado."
    ];

    return $erros[$codigo] ?? $erros["erro_desconhecido"];
}

$popup_titulo = '';
$popup_mensagem = '';
$popup_tipo = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome         = trim($_POST['nome'] ?? '');
    $valor        = floatval($_POST['valor'] ?? 0);
    $quantidade   = intval($_POST['quantidade'] ?? 0);
    $descricao    = trim($_POST['descricao'] ?? '');
    $sexo         = $_POST['sexo'] ?? null;
    $peso         = $_POST['peso'] ?? null;
    $idade        = $_POST['idade'] ?? null;
    $campeao      = strtolower($_POST['campeao'] ?? '') === 'sim' ? 1 : 0;
    $categoria    = intval($_POST['categoria'] ?? 0);
    $subcategoria = intval($_POST['subcategoria'] ?? 0);

    // 🔥 CATEGORIA 4 = Produto Geral (remove campos de animais)
    if ($categoria == 4) {
        $sexo = null;
        $peso = null;
        $idade = null;
        $campeao = null;
    }

    // 🔥 VALIDAÇÃO
    if (empty($nome))                   $erro = "nome_vazio";
    elseif ($valor <= 0)               $erro = "valor_invalido";
    elseif ($quantidade < 0)           $erro = "quantidade_invalida";
    elseif ($categoria <= 0)           $erro = "categoria_invalida";
    elseif ($subcategoria <= 0)        $erro = "subcategoria_invalida";
    elseif (empty($descricao))         $erro = "descricao_vazia";

    // Só valida animal se NÃO for categoria 4
    elseif ($categoria != 4 && empty($sexo))   $erro = "sexo_vazio";
    elseif ($categoria != 4 && $peso <= 0)     $erro = "peso_invalido";
    elseif ($categoria != 4 && empty($idade))  $erro = "idade_invalida";

    // Se houver erro → popup
    if (isset($erro)) {
        $_SESSION['popup_titulo'] = "Erro!";
        $_SESSION['popup_mensagem'] = mensagemErro($erro);
        $_SESSION['popup_tipo'] = "erro";

        header("Location: ../adm/adicionar_produto.php");
        exit;
    }

    // ============================
    //   UPLOAD DAS IMAGENS
    // ============================
    $pastaUpload = '../../view/public/uploads/';
    if (!is_dir($pastaUpload)) mkdir($pastaUpload, 0777, true);

    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $imagens_nomes = array_fill(0, 4, null);
    $uploadOk = false;

    for ($i = 0; $i < 4; $i++) {

        if (!empty($_FILES['imagens']['name'][$i])) {

            $tmp  = $_FILES['imagens']['tmp_name'][$i];
            $name = $_FILES['imagens']['name'][$i];
            $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $size = $_FILES['imagens']['size'][$i];

            if (!in_array($ext, $allowed)) {
                $erro = "img_formato"; break;
            }

            if ($size > 5 * 1024 * 1024) {
                $erro = "img_tamanho"; break;
            }

            $novoNome = "img" . ($i + 1) . "_" . time() . "." . $ext;
            $destino  = $pastaUpload . $novoNome;

            if (!move_uploaded_file($tmp, $destino)) {
                $erro = "img_falha_upload"; break;
            }

            $imagens_nomes[$i] = "uploads/" . $novoNome;
            $uploadOk = true;
        }
    }

    if (!$uploadOk) $erro = "sem_imagem";

    if (isset($erro)) {
        $_SESSION['popup_titulo'] = "Erro!";
        $_SESSION['popup_mensagem'] = mensagemErro($erro);
        $_SESSION['popup_tipo'] = "erro";

        header("Location: ../adm/adicionar_produto.php");
        exit;
    }

    // ============================
    //   INSERIR NO BANCO
    // ============================
    $jsonImgs = json_encode($imagens_nomes, JSON_UNESCAPED_UNICODE);

    $stmt = $con->prepare("INSERT INTO produto 
        (prod_nome, valor, quant_estoque, path_img, descricao, sexo, peso, idade, campeao, id_categoria, id_subcategoria)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "sdisssdsiii",
        $nome,
        $valor,
        $quantidade,
        $jsonImgs,
        $descricao,
        $sexo,
        $peso,
        $idade,
        $campeao,
        $categoria,
        $subcategoria
    );

    if ($stmt->execute()) {
        $_SESSION['popup_titulo'] = "Sucesso!";
        $_SESSION['popup_mensagem'] = "Produto cadastrado com sucesso!";
        $_SESSION['popup_tipo'] = "sucesso";
    } else {
        $_SESSION['popup_titulo'] = "Erro!";
        $_SESSION['popup_mensagem'] = mensagemErro("banco_erro");
        $_SESSION['popup_tipo'] = "erro";
    }

    $stmt->close();

    header("Location: ../adm/adicionar_produto.php");
    exit;
}
?>