<?php
include '../conexao.php';

$idVenda = $_REQUEST['id'];

echo "$idVenda e $idItem";

// Buscar os itens da venda para atualizar o estoque
$sqlBuscaItens = "SELECT produto_id, quantidade FROM item_venda WHERE venda_id='$idVenda'";
$resultadoItens = mysqli_query($conexao, $sqlBuscaItens);

while ($item = mysqli_fetch_assoc($resultadoItens)) {
    $produtoId = $item['produto_id'];
    $quantidade = $item['quantidade'];

    // Atualizar o estoque do produto
    $sqlAtualizaEstoque = "UPDATE produtos SET estoque = estoque + $quantidade WHERE id='$produtoId'";
    mysqli_query($conexao, $sqlAtualizaEstoque);
}

// Excluir os itens da venda
$sqlExcluirItens = "DELETE FROM item_venda WHERE venda_id='$idVenda'";
mysqli_query($conexao, $sqlExcluirItens);

// Excluir a venda
$sqlExcluirVenda = "DELETE FROM venda WHERE id='$idVenda'";
mysqli_query($conexao, $sqlExcluirVenda);

// Redirecionar para a página principal
header("Location:../listaVenda.php");
exit();
?>