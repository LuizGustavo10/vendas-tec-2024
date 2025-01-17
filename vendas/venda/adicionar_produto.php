<?php 

//adicionar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto'])) {

    // Adicionar produto diretamente à tabela item_venda
    $produtoId = $_POST['produto'];
    $quantidade = $_POST['quantidade'];

    // Buscar o preço do produto
    $result = $conexao->query("SELECT preco, estoque FROM produtos WHERE id = $produtoId");
    $produto = $result->fetch_assoc();
    $preco = $produto['preco'];
    $estoqueAtual = $produto['estoque'];

    // Atualizar o estoque do produto
    $novoEstoque = $estoqueAtual - $quantidade;
    $conexao->query("UPDATE produtos SET estoque = $novoEstoque WHERE id = $produtoId");

    // Inserir o produto na tabela item_venda
    $conexao->query("INSERT INTO item_venda (venda_id, produto_id, quantidade, valor) VALUES ($idVenda, $produtoId, $quantidade, $preco)");

    // Redirecionar para evitar reenvio de formulário
    header("Location: vendas.php?idVenda=$idVenda");
    exit();
}
?>