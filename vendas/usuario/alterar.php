<?php
include '../conexao.php';
//se existir algum atributo de requisição chamado id
if(isset($_REQUEST['id'])){

    //recebendo dados da tela
    $id = $_REQUEST['id'];
    $nome = $_REQUEST['nome'];
    $cpf = $_REQUEST['cpf'];
    $senha = $_REQUEST['senha'];

    $sql = "UPDATE usuario SET nome='$nome', cpf='$cpf', senha='$senha' WHERE id='$id' ";

    $resultado = mysqli_query($conexao, $sql);

    header('Location:../sistema.php');

}
header('Location:../sistema.php');

?>