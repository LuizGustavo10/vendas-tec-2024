

<?php
include ('conexao.php');

$produtoId = $_GET['id'];
$result = $conexao->query("SELECT preco FROM produtos WHERE id = $produtoId");
$produto = $result->fetch_assoc();
echo json_encode(['preco' => $produto['preco']]);
?>