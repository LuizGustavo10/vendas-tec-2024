<?php
// Conexão ao banco de dados
include('conexao.php');
include('validacao.php');

//caso já exista um id de venda
if (!empty($_GET['idVenda'])) {
    $idVenda = $_GET['idVenda'];
} else {
    // Criar uma nova venda se não houver uma em andamento
    $conexao->query("INSERT INTO venda (data_venda) VALUES (NOW())");
    $idVenda = $conexao->insert_id; // Obter o ID da nova venda
}


//adicionar produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['produto'])) {
    // Adicionar produto diretamente à tabela item_venda
    $produtoId = $_POST['produto'];
    $quantidade = $_POST['quantidade'];

    // Buscar o preço do produto
    $result = $conexao->query("SELECT preco FROM produtos WHERE id = $produtoId");
    $produto = $result->fetch_assoc();
    $preco = $produto['preco'];

    echo "$idVenda, $produtoId, $quantidade, $preco";
    // Inserir o produto na tabela item_venda
    $conexao->query("INSERT INTO item_venda (venda_id, produto_id, quantidade, valor) VALUES ($idVenda, $produtoId, $quantidade, $preco)");

    // Redirecionar para evitar reenvio de formulário
    header("Location: vendas.php?idVenda=$idVenda");
    exit();
}

// Totalizadores
$totalQuantidade = 0;
$totalValor = 0;

// Buscar os produtos da venda atual
$itensVenda = $conexao->query("SELECT iv.id,  p.nome, iv.produto_id, iv.quantidade, iv.valor FROM item_venda iv JOIN produtos p ON iv.produto_id = p.id WHERE iv.venda_id = $idVenda");

while ($item = $itensVenda->fetch_assoc()) {
    $totalQuantidade += $item['quantidade'];
    $totalValor += $item['quantidade'] * $item['valor'];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Venda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Tela de Venda</h1>
        <div class="row">
            <div class="col-md-8">
                <form id="form-produto" method="POST" action=""> 
                    <div class="row">
                        <div class="form-group col-md">
                            <label for="produto">Produto</label>
                            <select id="produto" name="produto" class="form-control">
                                <?php
                                $result = $conexao->query("SELECT id, nome FROM produtos");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" id="quantidade" name="quantidade" class="form-control" required>
                        </div>
                        <div class="col-md">
                            <button type="submit" class="btn btn-primary" style="margin-top: 25px;">Adicionar</button>
                        </div>
                    </div>
                </form>
                
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor Unitário</th>
                            <th>Valor Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $itensVenda->data_seek(offset: 0); // Reiniciar o ponteiro para a primeira linha
                        while ($item = $itensVenda->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$item['id']}</td>";
                            echo "<td>{$item['nome']}</td>";
                            echo "<td>{$item['quantidade']}</td>";
                            echo "<td>{$item['valor']}</td>";
                            echo "<td>" . ($item['quantidade'] * $item['valor']) . "</td>";
                            echo "<td><a href='./venda/remover_produto.php?idVenda=$idVenda&idItem={$item['id']}' class='btn btn-danger'>Remover</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <h3> Resumo da Venda</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="quantidade_total">Quantidade Total</label>
                        <input type="text" id="quantidade_total" name="quantidade_total" class="form-control" value="<?php echo $totalQuantidade; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="valor_total">Valor Total</label>
                        <input type="text" id="valor_total" name="valor_total" class="form-control" value="<?php echo number_format($totalValor, 2, ',', '.'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="obs">Observação</label>
                        <textarea id="obs" name="obs" class="form-control"></textarea>
                    </div>
                    <button type="submit" name="finalizar" class="btn btn-success mt-2">Finalizar Venda</button>
                    <a href="./sistema.php" class="btn btn-danger mt-2">Voltar</a>
                </form>
            </div>
        </div>
    </div>


    
    <script>
        document.getElementById('produto').addEventListener('change', function () {
            var produtoId = this.value;
            if (produtoId) {
                fetch('buscar_preco.php?id=' + produtoId)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('preco').value = data.preco;
                    });
            } else {
                document.getElementById('preco').value = '';
            }
        });
    </script>

</body>

</html>