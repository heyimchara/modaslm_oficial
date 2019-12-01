<div class="corpinho">     
    <div class="caixinha">
        <h2>Detalhes do pedido</h2>

Envio: <?= $pedido['id_pedido']?><br><br>
Usuário: <?= $pedido['nome']?><br><br>
Endereço: <?= $pedido['logradouro']?><br><br>
Pagamento: <?= $pedido['descricao']?><br><br>
DataCompra: <?= $pedido['data']?><br><br>

<h3>Produtos</h3>

<?php foreach ($produtos as $produto) : ?>

Produto: <?= $produto['nome']?><br><br>
Quantidade: <?= $produto['quantidade']?><br><br>

<?php endforeach; ?>

<a href="./produto/listarProdutos" class="btn btn-primary" <?php unset($_SESSION["carrinho"]); ?> >Novo Pedido</a>    
    </div>
</div>

