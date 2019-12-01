<div class="corpinho">     
    <div class="caixinha">
        
<h2>Meus Dados</h2>
<?php if (acessoPegarPapelDoUsuario() == 'admin') { ?>
        <p>Id: <?=$cliente['cod_cliente']?></p>
<?php } ?>      
        <p>Nome: <?=$cliente['nome']?></p>   
        <p>E-mail: <?=$cliente['email']?></p> 
        <p>CPF: <?=$cliente['cpf']?></p> 
        <p>Sexo: <?=$cliente['sexo']?></p>
        <p>Data de Nascimento: <?=$cliente['data']?></p>
        <p>Tipo de usuario: <?=$cliente['tipousuario']?></p>
<?php if (acessoPegarPapelDoUsuario() == 'admin') { 
        //<p>Senha: <?=$cliente['senha']
        
}else{ ?> 
        <p>Id: <?=$cliente['cod_cliente']?></p>
<?php } ?> 
        <br>

<?php
require_once 'visao/endereco/listar.visao.php';
?>

<a href = "./endereco/adicionar/<?=$cliente['cod_cliente']?>" style="text-align: center;" ><p>Novo Endereço</p></a><br>
  
<a href = "./cliente/editar/<?=$cliente['cod_cliente']?>" style="text-align: center;" ><p>Editar meus dados</p></a><br>

<a href = "./pedido/listarPedido/<?=$cliente['cod_cliente']?>" style="text-align: center;"><p>Meus pedidos</p></a><br>

<a href="login/logout" style="text-align: center;"><p>Sair</p></a>
  
    </div>
</div>
       
   
