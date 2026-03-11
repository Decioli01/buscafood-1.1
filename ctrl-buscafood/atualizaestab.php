<?php
  session_start();
  $id = $_GET['id_estab'];
    if(!empty($_GET['id_estab'])){
        include_once('./acoes/conexao.php');

        $id_estab = $_GET['id_estab'];

        $sqlSelect = "SELECT * FROM estabelecimentos WHERE estId = $id_estab";

        $result = $conn -> query($sqlSelect);

        if($result -> num_rows >0){
            while($user_data = mysqli_fetch_assoc($result)){
                $estabNome = $user_data['estNome'];
                $estabEnd = $user_data['estEndereco'];
                $cid_id = $user_data['cid_Id'];
                $lnk_ifood = $user_data['lnk_ifood'];
                $lnk_much = $user_data['lnk_much'];
                $lnk_aiqfome = $user_data['lnk_aiqfome'];
                $estWhatsapp = $user_data['estWhatsapp'];
                $lnk_face = $user_data['lnk_face'];
                $lnk_inst = $user_data['lnk_inst'];
            }
        }
        else{
            header('Location: listarestab.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

	<head>
		<meta charset="UTF-8">
		<title>Atualização de Estabelecimento - BuscaFood</title>
		<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
		<link rel="stylesheet" href="./css/cadestab.css">

	</head>
    
	<body>
        
		<!-- partial:index.partial.html -->
		<form action="./acoes/atualizaEstab.php?id_estab=<?php echo $id_estab?>" method="POST" enctype="multipart/form-data" class="wizard-section">

			<div class="row no-gutters">
				<div class="col-lg-6 col-md-6">
					<div class="wizard-content-left ">
						
						<div class="text-bg">
							<h3>Bem Vindo!</h3>
							<h1>Atualize Seu Estabelecimento!</h1>
						</div>
						<div class="img-logo">
							<img src="./images/Logo.svg" alt="">
						</div>
					</div>
				</div>

				<div class="col-lg-6 col-md-6">
					<div class="form-wizard">
						<form action="" method="post" role="form">
							<div class="form-wizard-header">

								<header class="header">
									<div id="logout" >
										<a href="listarestab.php">Cancelar</a>
									</div>
								</header>
								
								<p>Preencha todos os campos de formulário para dar o próximo passo</p>
								<ul class="list-unstyled form-wizard-steps clearfix">
									<li class="active"><span>1</span></li>
									<li><span>2</span></li>
									<li><span>3</span></li>
									<li><span>4</span></li>
								</ul>
							</div>

							<fieldset class="wizard-fieldset show">
								<h5>Informação pessoal</h5>
								<div class="form-group">
                                    <label for="fname" class="wizard-form-text-label">Nome do Estabelecimento*</label>
									<input type="text" name="estNome" class="form-control " id="fname" value="<?php echo $estabNome ?>">
									<div class="wizard-form-error"></div>
								</div>

								<div class="form-group clearfix">
									<a href="javascript:;" class="form-wizard-next-btn float-right">Próximo</a>
								</div>
							</fieldset>

							<!-- Endereço -->
							<fieldset class="wizard-fieldset">
								<h5>Endereço</h5>
								<div class="form-group">
									<input type="text" name="estEndereco" class="form-control " id="email" autocomplete value="<?php echo $estabEnd ?>">
									<label for="text" class="wizard-form-text-label">Logradouro</label>
									<div class="wizard-form-error"></div>
								</div>

								<div class="form-group">
									<select class="form-control " name="cid_Id" id="username">
										<option value="" selected hidden disabled>Cidade*</option>
										<option value="1">Tupã-SP</option>
									</select>
									<div class="wizard-form-error"></div>
								</div>

								<div class="form-group clearfix">
									<a href="javascript:;" class="form-wizard-previous-btn float-left">Voltar</a>
									<a href="javascript:;" class="form-wizard-next-btn float-right">Próximo</a>
								</div>
							</fieldset>

							<!-- Redese Social -->
							<fieldset class="wizard-fieldset">
								<h5>Redes Sociais</h5>
								<div class="form-group">
									<input type="text" name="estWhatsapp" value="<?php echo $estWhatsapp ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" class="form-control " id="bname">
									<label for="bname" class="wizard-form-text-label">WhatsApp* (apenas números)</label>
									<div class="wizard-form-error"></div>
								</div>

								<div class="form-group">
									<input type="text" name="lnk_face" class="form-control " id="brname" value="<?php echo $lnk_face ?>">
									<label for="brname" class="wizard-form-text-label">Facebook (link)</label>
									<div class="wizard-form-error"></div>
								</div>

								<div class="form-group">
									<input type="text" name="lnk_inst" class="form-control " id="acname" value="<?php echo $lnk_inst ?>">
									<label for="acname" class="wizard-form-text-label">Instagram (link)</label>
									<div class="wizard-form-error"></div>
								</div>

								<div class="form-group clearfix">
									<a href="javascript:;" class="form-wizard-previous-btn float-left">Voltar</a>
									<a href="javascript:;" class="form-wizard-next-btn float-right">Próximo</a>
								</div>
							</fieldset>

							<!-- Lojas -->
							<fieldset class="wizard-fieldset">
								<h5>App Delivery</h5>
								<div class="form-group">
									<input type="text" name="lnk_ifood" class="form-control " id="honame" value="<?php echo $lnk_ifood ?>">
									<label for="honame" class="wizard-form-text-label">Ifood (Link)</label>
									<div class="wizard-form-error"></div>
								</div>

								<div class="form-group">
									<input type="text" name="lnk_much" class="form-control " id="boname" value="<?php echo $lnk_much ?>">
									<label for="boname" class="wizard-form-text-label">Delivery Much (Link)</label>
									<div class="wizard-form-error"></div>
								</div>

								<div class="form-group">
									<input type="text" name="lnk_aiqfome" class="form-control " id="zoname" value="<?php echo $lnk_aiqfome ?>">
									<label for="zoname" class="wizard-form-text-label">Aiqfome (Link)</label>
									<div class="wizard-form-error"></div>
								</div>
								
								<div class="form-group clearfix">
									<a href="javascript:;" class="form-wizard-previous-btn float-left">Voltar</a>
									<input type="submit" href="javascript:;" class="form-wizard-submit float-right submit" id="submit" name="update" value="Atualizar"></a>
								</div>
							</fieldset>
                            <input type="hidden" name="id" value="<?php echo $id?>">
						</form>

					</div>

				</div>

			</div>
			
		</form>
		<!-- partial -->
		<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
        <script src="./script/script.js"></script>
	</body>

</html>