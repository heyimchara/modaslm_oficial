 <?php foreach ($produtos as $produto) : ?>
<div class="row" style="border-bottom:solid; margin-bottom:2%;">
  <div class="columns small-6"><h5>Produto</h5></div>
  <div class="columns small-2"><h5>Qtd</h5></div>
  <div class="columns small-2"><h5 style="float:right;">Preço</h5></div>
  <div class="columns small-2"></div>
</div>

<div class="row" style="border-bottom:solid; padding-bottom:2%;">
  <div class="columns small-6">
  <img src="<?=$produto['imagem']?>" alt="imagem" width="70px" height="70px" style="float:left;margin-right:2%;">
  <h4><a href="produto/ver/<?= $produto['cod_produto']?>"><?= $produto['nome']?></a></h4>
  <h6>Vendido e entregue por: MODAS LM</h6>
  </div>
    
  <div class="columns small-2">
  <select name="select">
  <option value="valor1" selected>1</option> 
  <option value="valor2" >2</option>
  <option value="valor3">3</option>
</select>
  </div>
    
   <div class="columns small-2">
        <h4 style="float:right;">R$<?= $produto['preco']?></h4>
   </div>
   <div class="columns small-2">
        <h4 style="float:right;"><a href="sacola/remover/<?=$produto['cod_produto']?>" style= margin-left:2%> Remover</a></h4>
   </div>
</div>
<br><br>
    <?php endforeach; ?>

        <p style="text-align: center;"><a href="sacola/limpar">Limpar Carrinho</a><br></p>
        <p style="text-align: center;"><a href="produto/listarProdutos">Continuar Comprando</a></p>
        <p style="text-align: center;">Total <span class="price" style="color:black"><b>R$ <?= $total?></b></span></p>
        <br>
        <p style="text-align: center;"><button class="hollow button" style="border: 1px solid #CC2EFA;color:#CC2EFA" ><a href="pedido/salvarPedido" class="btn btn-primary">Finalizar Compra</a></button></p>    