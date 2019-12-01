<?php

function pegarProdutosQuantidade() {
    $sql = "select * from produto";
    $resultado = mysqli_query(conn(), $sql);
    $produto = array();
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $produto[] = $linha;
    }
    return $produto;
}
function pegarProdutoCategoria() {
    $sql = "select produto.nome, categoria.nome as categ 
            from produto
            inner join categoria 
            on categoria.cod_categoria = produto.cod_categoria 
            order by categoria.nome";
    $resultado = mysqli_query(conn(), $sql);
    $produto = array();
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $produto[] = $linha;
    }
    return $produto;
}
function pegarTodosPedidosDatas($datad1, $datad2) {
    $sql = "select * from pedido where datacompra between '$datad1' and '$datad2'";
    $resultado = mysqli_query(conn(), $sql);
    $produto = array();
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $produto[] = $linha;
    }
    return $produto;
} 
function pegarPedidosEstado() {
    $sql = "select pedido.datacompra, pedido.total, endereco.cidade  
            from pedido
            inner join endereco 
            on endereco.idEndereco = pedido.logradouro 
            order by endereco.cidade";
 
    $resultado = mysqli_query(conn(), $sql);
    $pedido = array();
    while ($linha = mysqli_fetch_assoc($resultado)) {
        $pedido[] = $linha;
    }
    return $pedido;
}

function pegarTodosFaturamentos($tipoFaturamento) {
switch ($tipoFaturamento) {
case 'S':
$sql = "call faturamento_semanal";
break;
case 'M':
$sql = "call faturamento_mensal;";
break;
case 'A':
$sql = "call faturamento_anual";
break;
}
$resultado = mysqli_query(conn(), $sql);
$produto = array();
while ($linha = mysqli_fetch_assoc($resultado)) {
$produto[] = $linha;
}
return $produto;
}