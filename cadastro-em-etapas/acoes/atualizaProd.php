<?php
    session_start();

    $id_estab = $_POST['id']; //lê campo oculto

    include_once('conexao.php');

    if(isset($_POST['update'])){//recebe as informaçoes vindo do form
        $proId = $_GET['id_prod'];
        $proNome = $_POST['prodNome'];
        $proPrecoifood = $_POST['valorIfood'];
        $proPrecoDelMuch = $_POST['valorDelMuch'];
        $proPrecoAiqFome = $_POST['valorAiqFome'];
        $tam_Id = $_POST['tamanho'];
        $cat_Id = $_POST['categoria'];
        $proDescricao = $_POST['descricaoProd'];
                //atualiza os dados do produto vindo do form
        $sqlUpdate = "UPDATE produtos SET proNome='$proNome', preco_ifood='$proPrecoifood', preco_del_much='$proPrecoDelMuch',preco_aiqfome='$proPrecoAiqFome', tam_Id='$tam_Id', cat_Id='$cat_Id', proDescricao='$proDescricao',proAtualizacao=CURDATE() WHERE proId='$proId'";

        $result = $conn -> query($sqlUpdate);

        header("Location: ../listarprod.php?id_estab=".$id_estab."");//redireciona para a tela de listagem
    }
    

?>