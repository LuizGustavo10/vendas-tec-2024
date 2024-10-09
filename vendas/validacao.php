<?php
//iniciar sessão
session_start();

//se não existir a variavel de sessão cpf ou senha, manda pro login
if(!isset($_SESSION['cpf']) or !isset($_SESSION['senha'])){

    //destruir a sessão
    session_destroy();

    //limpar as variáveis de sessão
    unset($_SESSION['cpf']);
    unset($_SESSION['senha']);

    //manda para o login
    header('location:index.php');
}

?>