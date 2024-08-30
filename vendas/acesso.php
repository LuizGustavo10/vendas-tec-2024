<?php
    //importante arquivo de conexão com o banco
    include 'conexao.php';

    //recebendo os dados da tela de login do frontend

    $cpf = $_REQUEST['cpf'];
    $senha = $_REQUEST['senha'];
    
    //echo 'dados chegando login '.$cpf.' senha:. '.$senha;

    //consultando no banco de dados cpf e senha
    //seleciona o usuario onde o cpf="cpf do login" e senha = "senha do login"
    $sql = "SELECT * FROM usuario WHERE cpf= '$cpf' AND senha = '$senha' ";

    //executa código sql com permisão da conexão
    $resultado = mysqli_query($conexao, $sql);
    
    //cada valor é associado ao nome da coluna do banco
    $colunas = mysqli_fetch_assoc($resultado);

    //se o número de linhas retornado for maior que zero
    if(mysqli_num_rows($resultado) > 0){

        // inicia a sessão
        session_start();

        //cria váriaveis de sessão
        $_SESSION['usuario'] = $colunas['nome'];
        $_SESSION['cpf'] = $cpf;
        $_SESSION['senha'] = $senha;

        //direciona a pessoa para a página do sistema
        header('location: sistema.php');

    }else {
        //deslogar e destruir sessão
        session_unset();
        session_destroy();
        //direciona para o login
        header('location: index.php?erro=1');
    }

?>