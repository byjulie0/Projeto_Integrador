<div class="card_favorito">
    <a href="detalhes_produto.php" class="card-link">
        
        <div class="thumb">
            <?php if (!empty($imagem)): ?>
                <img src="<?php echo $imagem; ?>" alt="Imagem do produto favorito">
            <?php else: ?>
                <span class="img_fallback">Sem Imagem</span>
            <?php endif; ?>
        </div>

        <div class="info_card">
            <div>
                <h3 class="nome"><?php echo $nome ?? 'Nome Indisponível'; ?></h3>
                
                <div class="detalhes">
                    <p>Peso: <strong><?php echo $peso ?? 'N/A'; ?></strong></p>
                    <p>Raça: <strong><?php echo $raca ?? 'N/A'; ?></strong></p>
                    <p>Genealogia: <strong><?php echo $genealogia ?? 'N/A'; ?></strong></p>
                    <p>Idade: <strong><?php echo $idade ?? 'N/A'; ?></strong></p>
                </div>
            </div>
            
            <p class="preco">R$ <?php echo $preco ?? '0,00'; ?></p>
            
            <div class="acoes">
                <button class="btn_fav">★ Favorito</button> 
            </div>
        </div>
    </a>
</div>