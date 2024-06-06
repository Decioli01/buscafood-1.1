<?php
	session_start();
	$codest = $_GET['id_estab'];
			//recebe as informaçoes vindo do form
	empty($_REQUEST["prodNome"])        ? $proNome = ""         : $proNome = $_REQUEST["prodNome"];
	empty($_REQUEST["valorIfood"])      ? $precoIfood = ""      : $precoIfood = str_replace(",",".",$_REQUEST["valorIfood"]);
	empty($_REQUEST["valorDelMuch"])    ? $precoDelmuch = ""    : $precoDelmuch = str_replace(",",".",$_REQUEST["valorDelMuch"]);
	empty($_REQUEST["valorAiqFome"])    ? $precoAiqfome = ""    : $precoAiqfome = str_replace(",",".",$_REQUEST["valorAiqFome"]);
	empty($_REQUEST["categoria"])       ? $catProd = ""         : $catProd = $_REQUEST["categoria"];
	empty($_REQUEST["tamanho"])         ? $tam_Id = ""          : $tam_Id = $_REQUEST["tamanho"];
	empty($_REQUEST["descricaoProd"])   ? $descProd = ""        : $descProd = $_REQUEST["descricaoProd"];
	empty($_FILES["prodImg"])           ? $proImagem = ""       : $proImagem = $_FILES["prodImg"];

	include("conexao.php");
					//inserção dos dados vindo do formulario
	$sql = "Insert Into produtos(proNome, preco_ifood, preco_del_much, preco_aiqfome, cat_Id, tam_Id, proDescricao, proAtualizacao, est_Id)".
			"values ('".$proNome. "','".$precoIfood."','".$precoDelmuch."','".$precoAiqfome."','".$catProd."','".$tam_Id."','".$descProd."',
			CURDATE(),'".$codest."')";
			
	$consulta = mysqli_query($conn, $sql);
	$codprod = mysqli_insert_id($conn); //pega o campo chave da tabela (vai ser usado em upload)
	include("uploadprod.php"); //neste ponto chama o arquivo para fazer o upload da foto

	if (!$consulta) {
		die('Erro ao executar a consulta: ' . mysqli_error($conn));
	}
	header("location:../listarprod.php?id_estab=$codest"); //redireciona para um novo cadastro de produto
?>