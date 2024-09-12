<?php
// Conexão ao banco de dados
include('conexao.php');
include('validacao.php');


if (!empty($_GET['idVenda'])) {
    $id = $_GET['idVenda'];
    $sql = "SELECT * FROM venda WHERE id='$id' ";
    $dados = mysqli_query($conexao, $sql);
    $dadosAlteracao = mysqli_fetch_assoc($dados);

    //destino do formulário vai para o alterar.php
    $destino = './venda/alterar.php';

}


$_SESSION['carrinho'] = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['produto'])) {
        // Adicionar produto ao carrinho
        $produtoId = $_POST['produto'];
        $quantidade = $_POST['quantidade'];

        // Buscar detalhes do produto
        $result = $conexao->query("SELECT * FROM produtos WHERE id = $produtoId");
        $produto = $result->fetch_assoc();

        $item = [
            'id' => $produtoId,
            'nome' => $produto['nome'],
            'preco' => $produto['preco'],
            'quantidade' => $quantidade,
        ];

        $_SESSION['carrinho'][] = $item;
    } elseif (isset($_POST['finalizar'])) {
        // Finalizar venda
        $obs = $_POST['obs'];
        $valorTotal = $_POST['valor_total'];
        $quantidadeTotal = $_POST['quantidade_total'];

        $conexao->query("INSERT INTO venda (obs, valor_total, quantidade_total, data_venda) VALUES ('$obs', $valorTotal, $quantidadeTotal, NOW())");
        $vendaId = $conexao->insert_id;

        foreach ($_SESSION['carrinho'] as $item) {
            $conexao->query("INSERT INTO item_venda (venda_id, produto_id, quantidade, valor) VALUES ($vendaId, {$item['id']}, {$item['quantidade']}, {$item['preco']})");
        }

        // Limpar carrinho
        unset($_SESSION['carrinho']);
        $_SESSION['carrinho'] = [];
    }
}

// Totalizadores
$totalQuantidade = 0;
$totalValor = 0;
foreach ($_SESSION['carrinho'] as $item) {
    $totalQuantidade += $item['quantidade'];
    $totalValor += $item['quantidade'] * $item['preco'];
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
                        <div class=" form-group col-md">
                            <label for="preco">Valor</label>
                            <input type="text" id="preco" name="preco" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" id="quantidade" name="quantidade" class="form-control">
                        </div>
                        <div class="col-md">
                            <button type="submit" class="btn btn-primary" style="margin-top: 25px;">Adicionar</button>
                        </div>

                    </div>
                </form>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Quantidade</th>
                            <th>Valor Unitário</th>
                            <th>Valor Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($_SESSION['carrinho'] as $item) {
                            echo "<tr>";
                            echo "<td>{$item['nome']}</td>";
                            echo "<td>{$item['quantidade']}</td>";
                            echo "<td>{$item['preco']}</td>";
                            echo "<td>" . $item['quantidade'] * $item['preco'] . "</td>";
                            echo "<td><a href='remover_produto.php?id={$item['id']}' class='btn btn-danger'>Remover</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>


            <div class="col-md-4">
                <h3>Resumo da Venda</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="quantidade_total">Quantidade Total</label>
                        <input type="text" id="quantidade_total" name="quantidade_total" class="form-control"
                            value="<?php echo isset($dadosAlteracao) ? $dadosAlteracao['quantidade_total'] : $totalQuantidade ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="valor_total">Valor Total</label>
                        <input type="text" id="valor_total" name="valor_total" class="form-control"
                            value="<?php echo isset($dadosAlteracao) ? $dadosAlteracao['valor_total'] : $totalValor ?>"
                            readonly>
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