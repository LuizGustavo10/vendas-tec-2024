<?php
include '../conexao.php';

$idVenda = $_REQUEST['idVenda'];
$idItem = $_REQUEST['idItem'];
$qtd = $_REQUEST['qtd'];
$idProd = $_REQUEST['prod'];

// Atualizar o estoque do produto
$sqlAtualizaEstoque = "UPDATE produtos SET estoque = estoque + $qtd WHERE id='$idProd'";

echo "$idVenda $idItem $qtd $sqlAtualizaEstoque";
mysqli_query($conexao, $sqlAtualizaEstoque);

//exclui usuario aonde o id for igual a ?
$sql = "DELETE FROM item_venda WHERE id='$idItem' ";

//executa sql
$resultado = mysqli_query($conexao, $sql);

//direciona a pessoa para a pagina principal
 header("Location:../vendas.php?idVenda=$idVenda");

?>