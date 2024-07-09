<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- font awesome icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <!-- biblioteca de animação on scroll -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <!-- css comum -->
    <link rel="stylesheet" href="./css/style.css">

    <title>Produto</title>
</head>
<body class="produto-body">
    <header class="header">
        <a href="index.html" class="logo"><img id="logo" src="./images/LogoLight.png" alt=""></a>
        <div id="menu-btn" class="fas fa-bars icons"></div>       
        <nav class="navbar">
            <a href="index.html">Home</a>
            <a href="./contato.html">Contato</a>
            <a href="./sobreNos.html">Sobre Nós</a>
            <label class="switch">
                <input id="btnDarkMode" type="checkbox">
                <span class="slider"></span>
            </label>
        </nav>
        
    </header>
    <section class="produto">
        <div class="conteudos">
            <?php 
                include("conexao.php");
                // Pega o ID da produto por meio da URL vindo do card clicado
                $id_decriptado = mysqli_real_escape_string($conn, base64_decode($_GET['id']));
                
                // Realiza a busca no banco de dados, trazendo somente informações do produto em especifico
                $detalhes = "SELECT * , date_format(p.proAtualizacao, '%d %b %Y') as dataAtualizacao, LEAST (
                                COALESCE(NULLIF(p.preco_ifood, 0), 999999),
                                COALESCE(NULLIF(p.preco_del_much, 0), 999999),
                                COALESCE(NULLIF(p.preco_aiqfome, 0), 999999)
                            ) as menorPreco
                            FROM produtos p 
                            INNER JOIN tamanhos t ON t.tamId = p.tam_Id
                            INNER JOIN estabelecimentos e ON e.estId = p.est_Id
                            INNER JOIN cidades c ON c.cidId = e.cid_Id
                            where p.proId = $id_decriptado";

                $resultadoDetalhes = mysqli_query($conn, $detalhes);                
                
                $nota = "SELECT COUNT(nota_avaliada) as total_notas FROM avaliacao WHERE id_prod = $id_decriptado;";
                $nota_media = mysqli_fetch_array(mysqli_query($conn, $nota));

                // Percorre o array de resultados, imprimindo as informações do produto nos devidos lugares
                // Há 2 divs imprimindo as mesmas informações, porém uma delas será exibida enquanto o sistema estiver sendo exibido em uma tela wide (lanchonete-info cheia) e a outra somente enquanto tela mobile (lanchonete-info mobile)

                while($lancheDetalhe = mysqli_fetch_array($resultadoDetalhes)){ 
                  $id_loja_criptado = base64_encode($lancheDetalhe["estId"]);
                  echo "<div class='produto-desc'>
                  <p id='nota_media'>".$lancheDetalhe["avaliacao_media"]."<i class='fas fa-star'></i>(".$nota_media["total_notas"].")</p>
                  <h3>".$lancheDetalhe["proNome"]." (".$lancheDetalhe["tamNome"].")</h3>
                  <p id='desc-prod'>".$lancheDetalhe["proDescricao"].".</p>
                  <p>A partir de</p>
                  <h1> R$".$lancheDetalhe["menorPreco"]."</h1>
                  <h4> Atualizado em: ".$lancheDetalhe["dataAtualizacao"]."</h4>
                  <div class='desc-links'>
                      <h2>Peça já!</h2>
                      <div class='links'>";
                      if (!empty($lancheDetalhe["lnk_much"]) && $lancheDetalhe["preco_del_much"] != 0.00){
                          echo "<div class='deliveryPreco'>    
                                    <a href='".$lancheDetalhe['lnk_much']."' target='_blank'><img src='./images/DeliveryMuch LogoLight.svg' alt='AiQFome'></a>
                                    <p>R$".$lancheDetalhe["preco_del_much"]."</p>
                                </div>";
                      }
                      if (!empty($lancheDetalhe["lnk_ifood"]) && $lancheDetalhe["preco_ifood"] != 0.00){
                          echo "<div class='deliveryPreco'>    
                                    <a href='".$lancheDetalhe['lnk_ifood']."' target='_blank'><img src='./images/ifood-43 1.svg' alt='AiQFome'></a>
                                    <p>R$".$lancheDetalhe["preco_ifood"]."</p>
                                </div>";
                      }
                      if (!empty($lancheDetalhe["lnk_aiqfome"]) && $lancheDetalhe["preco_aiqfome"] != 0.00){
                          echo "<div class='deliveryPreco'>    
                                    <a href='".$lancheDetalhe['lnk_aiqfome']."' target='_blank'><img src='./images/logo_aiqfome.png' alt='AiQFome'></a>
                                    <p>R$".$lancheDetalhe["preco_aiqfome"]."</p>
                                </div>";
                      }
                      
                  echo "</div>
                  </div>

                  <div class='avaliacao-mobile'>
                        <p id='avaliacao-title'> Avalie este produto aqui! </p>
                        <form method='POST' action='avaliacao.php'>
                            <input type='hidden' name='id_prod' value='".base64_encode($id_decriptado)."'>
                            <div class=estrelas>
                                <input type='radio' id='vazio' name='estrela-mobile' value='' checked>

                                <label for='estrela_1'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_1' name='estrela-mobile' value='1'>

                                <label for='estrela_2'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_2' name='estrela-mobile' value='2'>

                                <label for='estrela_3'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_3' name='estrela-mobile' value='3'>

                                <label for='estrela_4'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_4' name='estrela-mobile' value='4'>

                                <label for='estrela_5'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_5' name='estrela-mobile' value='5'>
                            </div>
                            <input type='submit' onclick='avaliacao()' class='btn' id='btn-avaliar' value='Avaliar'>
                        </form>
                  </div>
                  <div class='produto-info'>
                      <div class='lanchonete-info mobile'>
                          <a href='./produtos_loja.php?id_loja=".$id_loja_criptado."'>
                            <h2 class='nome-lanchonete'>".$lancheDetalhe["estNome"]."</h2>
                          </a>
                          <p class='end-lanchonete'>
                              ".$lancheDetalhe["estEndereco"]."<br>"
                              .$lancheDetalhe["cidNome"].", ".$lancheDetalhe["ufSigla"]."<br>
                              
                          </p>
                          <div class='social-links'>";
                            if ($lancheDetalhe["estWhatsapp"] <> NULL){
                                echo "<a href='https://wa.me/55".$lancheDetalhe["estWhatsapp"]."'target='_blank'><i class='fab fa-whatsapp'></i></a>";
                            }                          
                            if ($lancheDetalhe["lnk_inst"] <> NULL){
                                echo "<a href='".$lancheDetalhe["lnk_inst"]."'target='_blank'><i class='fab fa-instagram'></i></a>";
                            }                          
                            if ($lancheDetalhe["lnk_face"] <> NULL){
                                echo "<a href='".$lancheDetalhe["lnk_face"]."'target='_blank''><i class='fab fa-facebook'></i></a>";
                            }                                                  
                      echo "</div>
                      </div>
                  </div>
              </div>
              <div class='produto-info' id='info-telaCheia'>
                  <p id='nota_media'>".$lancheDetalhe["avaliacao_media"]."<i class='fas fa-star'></i>(".$nota_media["total_notas"].")</p>
                  <img src='./images/produtos/".$lancheDetalhe["proImagem"]."' alt=''>
                  <div class='lanchonete-info cheia'>";
                  echo 
                  "<div class='avaliacao'>
                        <p id='avaliacao-title'> Avalie este produto aqui! </p>
                        <form method='POST' action='avaliacao.php'>
                            <input type='hidden' name='id_prod' value='".base64_encode($id_decriptado)."'>
                            <div class=estrelas>
                                <input type='radio' id='vazio' name='estrela' value='' checked>

                                <label for='estrela_um'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_um' name='estrela' value='1'>

                                <label for='estrela_dois'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_dois' name='estrela' value='2'>

                                <label for='estrela_tres'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_tres' name='estrela' value='3'>

                                <label for='estrela_quatro'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_quatro' name='estrela' value='4'>

                                <label for='estrela_cinco'><i class='fas fa-star'></i></label>
                                <input type='radio' id='estrela_cinco' name='estrela' value='5'>
                            </div>
                            <input type='submit' onclick='avaliacao()' class='btn' id='btn-avaliar' value='Avaliar'>
                        </form>
                  </div>";

                  echo 
                  "<a href='./produtos_loja.php?id_loja=".$id_loja_criptado."'>
                    <h2 class='nome-lanchonete'>".$lancheDetalhe["estNome"]."</h2>
                  </a>
                  <p class='end-lanchonete'>
                     ".$lancheDetalhe["estEndereco"]."<br>
                     ".$lancheDetalhe["cidNome"].", ".$lancheDetalhe["ufSigla"]."<br>
                  </p>
                  <div class='social-links'>";
                    if ($lancheDetalhe["estWhatsapp"] <> NULL){
                        echo "<a href='https://wa.me/55".$lancheDetalhe["estWhatsapp"]."'target='_blank'><i class='fab  fa-whatsapp'></i></a>";
                    }                          
                    if ($lancheDetalhe["lnk_inst"] <> NULL){
                        echo "<a href='".$lancheDetalhe["lnk_inst"]."'target='_blank'><i class='fab fa-instagram'></i></a>";
                    }                          
                    if ($lancheDetalhe["lnk_face"] <> NULL){
                        echo "<a href='".$lancheDetalhe["lnk_face"]."'target='_blank''><i class='fab fa-facebook'></i></a>";
                    }                                                  
                  echo "</div>
                  </div>
              </div>";
            }
        ?> 
        </div>
    </section>
    <script src="./js/script.js"></script>
    <script src="./js/darkMode.js"></script>
</body>
</html>