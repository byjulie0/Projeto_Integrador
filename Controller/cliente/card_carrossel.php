<?php
// Garantir que as variáveis básicas existam (evita warnings)
$imagem     = isset($imagem) ? $imagem : '../../view/public/imagens/placeholder.png';
$raca       = isset($raca) ? $raca : 'Não informado';
$peso       = isset($peso) ? $peso : '—';
$idade      = isset($idade) ? $idade : '—';
$preco      = isset($preco) ? $preco : '—';
$descricao  = isset($descricao) ? $descricao : '';
$genealogia = isset($genealogia) ? $genealogia : '—';
$id_produto = isset($id_produto) ? $id_produto : '';
?>
<link rel="stylesheet" href="../../view/public/css/cliente/card_carrossel.css">
<div class="card_cliente card-mais-vendidos card-cat-math">
  <img src="<?= htmlspecialchars($imagem, ENT_QUOTES, 'UTF-8') ?>" alt="Foto do produto <?= htmlspecialchars($raca, ENT_QUOTES, 'UTF-8') ?>" />

  <div class="card_info_grid">
    <p>Peso:</p>
    <p><?= htmlspecialchars($peso, ENT_QUOTES, 'UTF-8') ?></p>

    <p>Raça:</p>
    <p><?= htmlspecialchars($raca, ENT_QUOTES, 'UTF-8') ?></p>


    <p>Idade:</p>
    <p>
        <?php
        if (!empty($idade)) {
            try {
                $dataNascimento = new DateTime($idade);
                $dataAtual = new DateTime();
                $diferenca = $dataAtual->diff($dataNascimento);
                
                $anos = $diferenca->y;
                $meses = $diferenca->m;
                
                if ($anos >= 1) {
                    echo $anos . " ano" . ($anos > 1 ? "s" : "");
                } else {
                    echo $meses . " mês" . ($meses != 1 ? "es" : "");
                }
            } catch (Exception $e) {
                echo "Data inválida";
            }
        } else {
            echo "Não informado";
        }
        ?>
      </p>
  </div>

  <!-- Se quiser exibir o preço ou descrição dentro do card, descomente:
  <div class="card_footer">
    <p class="preco">R$ <?= htmlspecialchars($preco, ENT_QUOTES, 'UTF-8') ?></p>
    <p class="descricao"><?= htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8') ?></p>
  </div>
  -->

</div>
