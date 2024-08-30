<?php
    $nome = 'Julio';

    echo 'O meu nome é: '.$nome;

    $idade = 29;

    if($idade == 26){
        echo '<br> Tem 26 anos';
    }else{
        echo '<br>  Não tem 26 anos';
    }

    for($contador=0; $contador < 10; $contador++){
        echo '<hr>';
        echo $contador;
    }

    $lista = ['Gilmar','Jhonas','Macabeu','Amadeu'];
    echo '<br>';
    echo $lista[2];

    for($contador=0; $contador < count($lista); $contador++){
        echo '<hr>';
        echo $contador.' - '.$lista[$contador];
    }



?>