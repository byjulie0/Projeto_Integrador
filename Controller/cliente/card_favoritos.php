<div class="card-mais-vendidos">
    <img src="<?php echo $imagem; ?>" alt="Imagem do produto" class="img_mais-vendidos">
    
    <div class="info-grid-mais-vendidos">
        <p>Raça:</p> <p><?php echo $raca; ?></p>
        <p>Peso:</p> <p><?php echo $peso; ?></p>
        <p>Idade:</p> <p><?php echo $idade; ?></p>
        <p>Genealogia:</p> <p><?php echo $genealogia; ?></p>
    </div>

    <p class="price-mais-vendidos">R$<?php echo $preco; ?></p>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px;">
        <form method="post" action="excluir_favorito.php">
            <input type="hidden" name="id" value="<?php echo $id ?? ''; ?>">
            <button class="excluir-pag-fav" title="Remover dos favoritos">Excluir</button>
        </form>
        <span class="stars-pag-fav" title="Item favoritado">★</span>
    </div>

    <a href="#" class="btn-mais-vendidos">Comprar</a>
</div>
