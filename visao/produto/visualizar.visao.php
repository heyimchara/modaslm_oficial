<div class="row">
  <div class="columns medium-5">
     <img src="<?=$produto['imagem']?>" alt="" width="200px" height="200px">
  </div>

   <div class="columns medium-5">
    <h4><?=$produto['nome']?></h4>
    <p>R$ <?=$produto['preco']?></p>
    <p>Tamanho:</p>
    <select name="select">
    <option value="valor1" selected>Escolha o tamanho</option> 
    <option value="valor2" >P</option>
    <option value="valor3">M</option>
    <option value="valor3">G</option>
    <option value="valor3">GG</option>
    </select>

    <br><br>
    <p style="text-align:center;"><button class="hollow button" href="#" style="border: 1px solid #CC2EFA;color:#CC2EFA" ><a href="./produto/comprar/<?=$produto['cod_produto']?>">Adicionar ao carrinho</a></button></p>

   </div>
    
</div>

<br>

<div class="row">
<h3>Detalhes do produto</h3>
<ul>
        <li><?=$produto['descricao']?></li>
<?php if (acessoPegarPapelDoUsuario() == 'admin') { ?>
        <li><p> Id: <?=$produto['cod_produto']?></p></li>
        <li><p> Categoria: <?=$produto['cod_categoria']?></p> </li>
        <li><p> estoque_minimo: <?=$produto['estoque_minimo']?></p></li>
        <li><p> estoque_maximo: <?=$produto['estoque_maximo']?></p></li>
<?php } ?>
</ul>
</div>