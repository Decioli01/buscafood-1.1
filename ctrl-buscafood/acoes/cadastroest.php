<?php
	session_start();
	$id_estab = $_GET['id'];
			//recebe as informaçoes vindo do form
	empty($_REQUEST["estNome"])         ? $estNome = ""         : $estNome = $_REQUEST["estNome"];
	empty($_FILES["estLogo"])         	? $estLogo = NULL         : $estLogo = $_FILES["estLogo"];
	empty($_REQUEST["estEndereco"])     ? $estEndereco = ""     : $estEndereco = $_REQUEST["estEndereco"];
	empty($_REQUEST["cid_Id"])          ? $cid_Id = ""          : $cid_Id = $_REQUEST["cid_Id"];
	empty($_REQUEST["estWhatsapp"])     ? $estWhatsapp = NULL     : $estWhatsapp = $_REQUEST["estWhatsapp"];
	empty($_REQUEST["lnk_face"])        ? $lnk_face = NULL        : $lnk_face = $_REQUEST["lnk_face"];
	empty($_REQUEST["lnk_inst"])        ? $lnk_inst = NULL        : $lnk_inst = $_REQUEST["lnk_inst"];
	empty($_REQUEST["lnk_ifood"])       ? $lnk_ifood = NULL       : $lnk_ifood = $_REQUEST["lnk_ifood"];
	empty($_REQUEST["lnk_much"])        ? $lnk_much = NULL       : $lnk_much = $_REQUEST["lnk_much"];
	empty($_REQUEST["lnk_aiqfome"])     ? $lnk_aiqfome = NULL    : $lnk_aiqfome = $_REQUEST["lnk_aiqfome"];

	include("conexao.php");
			//Select para verificar se o estabelecimento já não está cadastrado
	$sql = "Select * from estabelecimentos where estNome = '".$estNome."'";
	$resultado = mysqli_query($conn,$sql);
	
	if (mysqli_num_rows($resultado) > 0) {
		?> <script>	alert("Estabelecimento já cadastrado"); </script> <?php 
	}
	else {
				//Inserção dos dados vindo do formulario
		$sql = "INSERT INTO estabelecimentos (estNome, estEndereco, cid_Id, estWhatsapp, lnk_face, lnk_inst, lnk_ifood, lnk_much, lnk_aiqfome) " .
		"VALUES ('".$estNome."', '".$estEndereco."', '".$cid_Id."','".$estWhatsapp."', '".$lnk_face."', '".$lnk_inst."', '".$lnk_ifood."', '".$lnk_much."', '".$lnk_aiqfome."')";
 			
		$consulta = mysqli_query($conn, $sql);
		if (!$consulta) {
    		die('Erro ao executar a consulta: ' . mysqli_error($conn));
		}
		$codest = mysqli_insert_id($conn); //pega o campo chave da tabela (vai ser usado em upload)
		include("uploadest.php"); //neste ponto chama o arquivo para fazer o upload da foto
	}

	$consulta = mysqli_query($conn, $sql);
		
	header("location:../listarestab.php"); //redireciona para o cadastro de produto
?>
<script>
	alert("Estabelecimento cadastrado com sucesso!");
</script>