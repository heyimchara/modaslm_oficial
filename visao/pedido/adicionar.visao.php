<?php foreach ($produtos as $produto) : ?>
<div class="row" style="border-bottom:solid; margin-bottom:2%;">
  <div class="columns small-6"><h5>Produto</h5></div>
  <div class="columns small-6"><h5 style="float:right;">Preço</h5></div>
</div>
<div class="row" style="border-bottom:solid; padding-bottom:2%;">
  <div class="columns small-6">
  <img src="<?=$produto['imagem']?>" alt="Vazio!" width="70px" height="70px" style="float:left;margin-right:2%;">
  <h4><a href="produto/ver/<?= $produto['cod_produto']?>"><?= $produto['nome']?></a></h4>
  </div>
  <div class="columns small-6">
<h4 style="float:right;">R$ <?= number_format($produto["preco"],2) ?></h4>
  </div>
    </div>
<br><br>
<?php endforeach; ?>

<div class="row">
  <div class="columns small-6">
<form action="pedido/desconto" method="POST">
      <h5>Digite o código de seu cupom ou vale:</h5>
      <div class=" small-6">
      <input type="text" name="id_cupom" id="left-label" placeholder="">
      </div>
      <button class="hollow button" href="#" style="border: 1px solid #CC2EFA;color:#CC2EFA" >Calcular</button>
</form> 
  </div>

<form action="pedido/salvarPedido" method="POST"> 
  <div class="columns small-6">
  <h5 style="text-align:center;">Finalizar</h5>
  <form>
  <div class="grid-x grid-padding-x">
    <div class="small-3 cell">
      <label for="middle-label" class="text-right middle"><h5>Forma de Pagamento:</h5></label>
    </div>
    <div class="small-7 cell">
    <select name="cod_formadepagamento">
<option value="default"></option>
<?php foreach ($formasdepagamento as $formadepagamento): ?>
<option value="<?=$formadepagamento["cod_formadepagamento"]?>"><?=$formadepagamento["descricao"]?></option>
<?php endforeach;?>
    </select>
    </div>
  </div>
      
  <div class="grid-x grid-padding-x">
    <div class="small-3 cell">
      <label for="middle-label" class="text-right middle"><h5>Endereço:</h5></label>
    </div>
    <div class="small-7 cell">
<select name="logradouro">
<option value="default"></option>
<?php foreach ($enderecos as $endereco): ?>
<option value="<?=$endereco["idEndereco"]?>"><?=$endereco["logradouro"]?></option>
<?php endforeach;?>
</select> 
    </div>
  </div>
      
  <div class="grid-x grid-padding-x">
    <div class="small-3 cell">
      <label for="middle-label" class="text-right middle"></label>
    </div>
    <div class="small-7 cell">
      <p><h5>Total: <?=$total?></h5></p>
  <p style="text-align:center;"><button class="hollow button" href="#" style="border: 1px solid #CC2EFA;color:#CC2EFA" >Finalizar</button></p>
  </form>
</div>
</div>
    </div>
 