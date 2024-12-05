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

include './venda/adicionar_produto.php';
include './venda/atualizar_tabela.php';

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
                        <div class="form-group col-md-8">
                            <label for="produto">Produto</label>

                            <select id="produto" name="produto" class="form-control">
                                <?php
                                $result = $conexao->query("SELECT id, nome, preco, estoque FROM produtos");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='{$row['id']}'>{$row['nome']} - Preco: {$row['preco']} - Quantidade: {$row['estoque']}</option>";
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

                <table class="table mt-4 table-bordered">
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
                            echo "<td><a href='./venda/remover_produto.php?
                            idVenda=$idVenda
                            &idItem={$item['id']}
                            &qtd={$item['quantidade']}
                            &prod={$item['produto_id']}
                            ' class='btn btn-danger'>Remover</a></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-md-4">
                <h3> Resumo da Venda</h3>
                <form method="POST" action="./venda/finalizar_venda.php">
                    <div class="form-group">
                        <label for="quantidade_total">Quantidade Total</label>
                        <input type="text" id="quantidade_total" name="quantidade_total" class="form-control"
                            value="<?php echo $totalQuantidade; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="valor_total">Valor Total</label>
                        <input type="text" id="valor_total" name="valor_total" class="form-control"
                            value="<?php echo number_format($totalValor, 2, ',', '.'); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="obs">Observação</label>
                        <textarea id="obs" name="obs" class="form-control"></textarea>
                    </div>
                    <a href="./listaVendas.php" type="submit" name="finalizar" class="btn btn-success mt-2">Finalizar</a>
                    <a href="./venda/remover_venda.php?id=<?=$idVenda?>" class="btn btn-danger mt-2"> Cancelar   </a>
                </form>
            </div>
        </div>
    </div>




</body>

</html>