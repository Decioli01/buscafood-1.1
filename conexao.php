<?php 
    $host = "127.0.0.1";
    $usuario = "root";
    $senha = "";
    $bd = "busca_food";

    $conn = @mysqli_connect($host, $usuario, $senha, $bd);

    if ($conn)
    {
        $banco = @mysqli_select_db($conn, $bd);
    }
    else{
        printf('Erro! Conexão não realizada!');
    }
?>