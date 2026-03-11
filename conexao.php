<?php 
    $host = "127.0.0.1";
    $usuario = "user_comum";
    $senha = "usuario_comum123";
    $bd = "busca_food_2";

    $conn = @mysqli_connect($host, $usuario, $senha, $bd);

    if ($conn)
    {
        $banco = @mysqli_select_db($conn, $bd);
    }
    else{
        printf('Erro! Conexão não realizada!');
    }
?>