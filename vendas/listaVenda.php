<?php

include ('conexao.php');
include ('validacao.php');

//destino do formulário vai para o inserir
$destino = './venda/inserir.php';

//se existir algum idAlt
if(!empty($_GET['idAlt'])){
  $_SESSION['idVenda'] = $_GET['idAlt'];
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Sistema de Cardápios </title>
  <link rel="stylesheet" href="estilo.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />



</head>

<body>

  <?php include './modulosMenu/menuSuperior.php' ?>
  
  
  
  <div class="container-fluid">
    
    <!-- linha -->
    <div class="row">
      <!-- coluna -->
      <div class="col-md-3 menu">
        <?php include './modulosMenu/menuLateral.php'?>
      </div>
      <div class="col-md-9">

        <div class="row">
          


          <div class="col-md card">
            <table class="table " id="tabela">
              <thead>
                <tr>
                  <th scope="col" class="col-1">cód</th>
                  <th scope="col"> Total </th>
                  <th scope="col"> Quantidade </th>
                  <th scope="col"> Data </th>
                  <th scope="col"> OBS </th>
                  <th scope="col" class="col-2"> Opções </th>
                </tr>
              </thead>
              <tbody>

                <?php
                  //sql para selecionar todos dadosAlteracao
                  $sql = "SELECT * FROM venda";
                  //executa o sql e armazena
                  $resultado = mysqli_query($conexao, $sql);

                  while($coluna = mysqli_fetch_assoc($resultado)){
                ?>

                <tr>

                  <td> <?php echo $coluna['id'] ?> </td>
                  <td> <?php echo $coluna['valor_total'] ?> </td>
                  <td> <?php echo $coluna['quantidade_total'] ?> </td>
                  <td> <?php echo $coluna['data_venda'] ?> </td>
                  <td> <?php echo $coluna['obs'] ?> </td>
                  <td>
                    <a href="vendas.php?idAlt=<?= $coluna['id'] ?>" title="Editar"> <i class="fa-solid fa-pen-to-square editar"></i> </a>
                    <a href="<?php echo './venda/excluir.php?id='.$coluna['id']; ?>" title="Excluir"> <i class="fa-solid fa-trash excluir"></i></a>
                  </td>
                </tr>
                
                <?php } ?>

              </tbody>
            </table>
          </div>


        </div>
      </div>

    </div>

  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>


  <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="script.js"></script>

</body>

</html>