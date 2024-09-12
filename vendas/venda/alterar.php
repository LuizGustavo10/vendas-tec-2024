<?php
include '../conexao.php';
//se existir algum atributo de requisição chamado id
if(isset($_REQUEST['id'])){

    //recebendo dados da tela
    $id = $_REQUEST['id'];
    $nome = $_REQUEST['nome'];
    $estado = $_REQUEST['estado'];
    $cep = $_REQUEST['cep'];

    $sql = "UPDATE cidade SET nome='$nome', estado='$estado', cep='$cep' WHERE id='$id' ";

    $resultado = mysqli_query($conexao, $sql);

    header('Location:../cidade.php');

}
header('Location:../cidade.php');

?>