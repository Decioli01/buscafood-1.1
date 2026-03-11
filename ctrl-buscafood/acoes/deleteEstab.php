<?php
  session_start();
  $id_estab = $_GET['id_estab'];

  if(!empty($_GET['id_estab'])){

    include_once('conexao.php');

            //select para verificar se o produto esta cadastrado
    $sqlSelect = "SELECT * FROM estabelecimentos WHERE estId=$id_estab";
        
    $result = $conn -> query($sqlSelect);
          //caso cadastrado, aqui fara a exclusao dele
    if($result -> num_rows > 0){
      $sqlDelete = "DELETE FROM estabelecimentos WHERE estId=$id_estab";
      $resultDelete = $conn -> query($sqlDelete);
    }
  }

  header('Location: ../listarestab.php');//redireciona para a tela de listagem
   
   
?>