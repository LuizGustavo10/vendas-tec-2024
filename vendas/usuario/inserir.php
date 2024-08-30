<?php
include('../conexao.php');

//receber dados do formulário
$nome = $_REQUEST['nome'];
$cpf = $_REQUEST['cpf'];
$senha = $_REQUEST['senha'];

//echo 'dados chegando'.$nome.$cpf.$senha;

$sql = "INSERT INTO usuario(nome, cpf, senha) VALUES ('$nome','$cpf','$senha')";

//executar sql
$resultado = mysqli_query($conexao, $sql);

//mandar a pessoa para a pagina inicial
header("Location:../sistema.php");

?>

