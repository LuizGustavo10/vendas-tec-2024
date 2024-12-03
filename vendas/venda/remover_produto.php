<?php
include '../conexao.php';

$idVenda = $_REQUEST['idVenda'];
$idItem = $_REQUEST['idItem'];

echo "$idVenda e $idItem";

//exclui usuario aonde o id for igual a ?
$sql = "DELETE FROM item_venda WHERE id='$idItem' ";
//executa sql
$resultado = mysqli_query($conexao, $sql);

//direciona a pessoa para a pagina principal
 header("Location:../vendas.php?idVenda=$idVenda");

?>