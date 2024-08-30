<!-- <php
$endereco = "sql204.infinityfree.com"; //localhost
$nome = "if0_36845851_projetoescola";   //projetoescola
$usuario = "if0_36845851";         //root
$senha = "luizsenac123";               //vazio

$conexao = mysqli_connect($endereco, $usuario, $senha, $nome);

?> -->


<?php
$endereco = "localhost"; //localhost
$nome = "projetoescola2";   //projetoescola
$usuario = "root";         //root
$senha = "";               //vazio
$conexao = mysqli_connect($endereco, $usuario, $senha, $nome);
$conexao->set_charset("utf8");


?>