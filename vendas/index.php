<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>    
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="recursos/particula.css">
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="fundo">

    <div class="painel">
        <form action="acesso.php" method="post">

            <div class="topo">
                <i  class="fa-solid fa-user-astronaut usuario"></i>
                <h3>Sistema NutriEscola</h3>

                <?php
                    //se existir uma variavel erro E se essa variavel erro=1
                    if(isset($_GET['erro']) && $_GET['erro'] == 1){
                        echo '<p class="mensagem"> CPF ou senha incorretos! </p>';
                    }

                ?>

            </div>

            <div class="form-group">
              <label>  CPF </label>
              <input name="cpf" type="text" class="form-control cpf" id="cpf" placeholder="cpf">
            </div>

            <div class="form-group">
              <label> Senha</label>
              <input name="senha" type="password" class="form-control" id="senha" placeholder="Senha">
            </div>
  
            <button type="submit" class="btn btn-primary">Enviar</button>
            <button type="reset" class="btn btn-primary">Limpar</button>
           
          </form>  
    </div>

    
    <!-- particles.js container -->
    <div id="particles-js"></div> <!-- stats - count particles -->

    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> <!-- stats.js lib -->
    <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>



    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="script.js"></script>
    <script src="recursos/particula.js"></script>

</body>
</html>

