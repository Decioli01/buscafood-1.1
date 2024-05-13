<?php
    session_start();

    $id_estab = $_POST['id']; //lê campo oculto

    include_once('conexao.php');

    if(isset($_POST['update'])){//recebe as informaçoes vindo do form
        empty($_REQUEST["estNome"])         ? $estNome = ""           : $estNome = $_REQUEST["estNome"];
        empty($_FILES["estLogo"])         	? $estLogo = NULL         : $estLogo = $_FILES["estLogo"];
        empty($_REQUEST["estEndereco"])     ? $estEndereco = ""       : $estEndereco = $_REQUEST["estEndereco"];
        empty($_REQUEST["cid_Id"])          ? $cid_Id = ""            : $cid_Id = $_REQUEST["cid_Id"];
        empty($_REQUEST["estWhatsapp"])     ? $estWhatsapp = NULL     : $estWhatsapp = $_REQUEST["estWhatsapp"];
        empty($_REQUEST["lnk_face"])        ? $lnk_face = NULL        : $lnk_face = $_REQUEST["lnk_face"];
        empty($_REQUEST["lnk_inst"])        ? $lnk_inst = NULL        : $lnk_inst = $_REQUEST["lnk_inst"];
        empty($_REQUEST["lnk_ifood"])       ? $lnk_ifood = NULL       : $lnk_ifood = $_REQUEST["lnk_ifood"];
        empty($_REQUEST["lnk_much"])        ? $lnk_much = NULL        : $lnk_much = $_REQUEST["lnk_much"];
        empty($_REQUEST["lnk_aiqfome"])     ? $lnk_aiqfome = NULL     : $lnk_aiqfome = $_REQUEST["lnk_aiqfome"];
                //atualiza os dados do produto vindo do form
        $sqlUpdate = "UPDATE estabelecimentos 
                        SET estNome='$estNome', 
                            estEndereco='$estEndereco',
                            cid_Id='$cid_Id',
                            estWhatsapp='$estWhatsapp',
                            lnk_face='$lnk_face',
                            lnk_inst= '$lnk_inst',
                            lnk_ifood = '$lnk_ifood',
                            lnk_much = '$lnk_much',
                            lnk_aiqfome = '$lnk_aiqfome'
                        WHERE estId='$id_estab'";

        $result = $conn -> query($sqlUpdate);
        
        if (!$result) {
    		die('Erro ao executar a consulta: ' . mysqli_error($conn));
        }

        header("Location: ../listarestab.php");//redireciona para a tela de listagem
    }
?>