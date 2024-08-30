<?php
include ('conexao.php');
include ('validacao.php');



// Adicionar Produto
if (isset($_POST['add_product'])) {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $estoque = $_POST['estoque'];

    $sql = "INSERT INTO produtos (nome, preco, estoque) VALUES ('$nome', '$preco', '$estoque')";
    if ($conexao->query($sql) === TRUE) {
        $msg = "Produto adicionado com sucesso!";
    } else {
        $msg = "Erro: " . $sql . "<br>" . $conexao->error;
    }
}

// Registrar Venda
if (isset($_POST['sell_product'])) {
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];

    // Verificar estoque
    $result = $conexao->query("SELECT * FROM produtos WHERE id=$produto_id");
    $produto = $result->fetch_assoc();
    
    if ($produto['estoque'] >= $quantidade) {
        $total = $produto['preco'] * $quantidade;
        $novo_estoque = $produto['estoque'] - $quantidade;

        // Registrar venda
        $sql = "INSERT INTO vendas (produto_id, quantidade, total, data_venda) VALUES ('$produto_id', '$quantidade', '$total', NOW())";
        $conexao->query($sql);

        // Atualizar estoque
        $conexao->query("UPDATE produtos SET estoque='$novo_estoque' WHERE id='$produto_id'");
        $msg = "Venda registrada com sucesso!";
    } else {
        $msg = "Estoque insuficiente!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Sistema de Vendas</h2>

    <?php if (isset($msg)): ?>
        <div class="alert alert-info">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <h4>Adicionar Produto</h4>
            <form method="post">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome do Produto</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="preco" class="form-label">Preço</label>
                    <input type="text" class="form-control" id="preco" name="preco" required>
                </div>
                <div class="mb-3">
                    <label for="estoque" class="form-label">Estoque</label>
                    <input type="number" class="form-control" id="estoque" name="estoque" required>
                </div>
                <button type="submit" name="add_product" class="btn btn-primary">Adicionar Produto</button>
            </form>
        </div>

        <div class="col-md-6">
            <h4>Vender Produto</h4>
            <form method="post">
                <div class="mb-3">
                    <label for="produto_id" class="form-label">Produto</label>
                    <select class="form-select" id="produto_id" name="produto_id" required>
                        <?php
                        $result = $conexao->query("SELECT * FROM produtos");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nome'] . " (R$" . $row['preco'] . ")</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" required>
                </div>
                <button type="submit" name="sell_product" class="btn btn-success">Vender Produto</button>
            </form>
        </div>
    </div>

    <h4 class="mt-5">Histórico de Vendas</h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Total</th>
                <th>Data da Venda</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conexao->query("SELECT vendas.*, produtos.nome FROM vendas JOIN produtos ON vendas.produto_id = produtos.id");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['quantidade'] . "</td>";
                echo "<td>" . $row['total'] . "</td>";
                echo "<td>" . $row['data_venda'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conexao->close();
?>
