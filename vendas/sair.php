<?php
    session_start();
    session_destroy();

    //limpar váriaveis de sessão
    unset($_SESSION['cpf']);
    unset($_SESSION['senha']);

    //manda para o login
    header('location:login.php');

?>