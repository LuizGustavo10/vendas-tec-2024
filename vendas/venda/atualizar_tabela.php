<?php

// Totalizadores
$totalQuantidade = 0;
$totalValor = 0;

// Buscar os produtos da venda atual
$itensVenda = $conexao->query("SELECT iv.id,  p.nome, iv.produto_id, iv.quantidade, iv.valor FROM item_venda iv JOIN produtos p ON iv.produto_id = p.id WHERE iv.venda_id = $idVenda");

while ($item = $itensVenda->fetch_assoc()) {
    $totalQuantidade += $item['quantidade'];
    $totalValor += $item['quantidade'] * $item['valor'];
}

$conexao->query("
UPDATE venda 
SET 
    data_venda = NOW(), 
    obs = 'observação', 
    valor_total = $totalValor, 
    quantidade_total =  $totalQuantidade
WHERE id = $idVenda
");


?>