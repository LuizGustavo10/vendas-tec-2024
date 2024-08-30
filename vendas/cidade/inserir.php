<?php
include('../conexao.php');

//receber dados do formulário
$nome = $_REQUEST['nome'];
$estado = $_REQUEST['estado'];
$cep = $_REQUEST['cep'];

//echo 'dados chegando'.$nome.$cpf.$senha;

$sql = "INSERT INTO cidade(nome, estado, cep) VALUES ('$nome','$estado','$cep')";

//executar sql
$resultado = mysqli_query($conexao, $sql);

//mandar a pessoa para a pagina inicial
header("Location:../cidade.php");

?>

