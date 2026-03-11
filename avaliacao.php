<?php 
    $id_decriptado = base64_decode($_POST['id_prod']);

    include_once ("./ctrl-buscafood/acoes/conexao.php");

    if (isset($_POST['estrela'])){
        if (!empty($_POST['estrela'])) {
            $nota = $_POST['estrela'];
            $insert_avaliacao = "CALL media_nota($nota, $id_decriptado)";
            $executa_insert = mysqli_query($conn, $insert_avaliacao);
            if ($executa_insert) {
                ?>
                <script>
                setTimeout(function() {
                    alert('Sua avaliação foi feita com sucesso!');
                    window.location.href = 'produto.php?id=<?php echo base64_encode($id_decriptado) ?>';
                }, 500); // 500 milissegundos de atraso (0,5 segundos)
                </script>
                <?php
                exit; // Adicione isso para garantir que o script PHP pare de ser executado após o redirecionamento
            } 
            else {
                die('Erro ao executar a consulta: ' . mysqli_error($conn));
            }
        } else {
            header("location: produto.php?id=".base64_encode($id_decriptado)."");
            exit; // Adicione isso para garantir que o script PHP pare de ser executado após o redirecionamento
        }
    }
    elseif (isset($_POST['estrela-mobile'])){
        if (!empty($_POST['estrela-mobile'])) {
            $nota_mobile = $_POST['estrela-mobile'];
            $insert_avaliacao = "CALL media_nota($nota_mobile, $id_decriptado)";
            $executa_insert = mysqli_query($conn, $insert_avaliacao);
            if ($executa_insert) {
                ?>
                <script>
                setTimeout(function() {
                    alert('Sua avaliação foi feita com sucesso!');
                    window.location.href = 'produto.php?id=<?php echo base64_encode($id_decriptado) ?>';
                }, 500); // 500 milissegundos de atraso (0,5 segundos)
                </script>
                <?php
                exit; // Adicione isso para garantir que o script PHP pare de ser executado após o redirecionamento
            } else {
                die('Erro ao executar a consulta: ' . mysqli_error($conn));
            }
        } else {
            header("location: produto.php?id=".base64_encode($id_decriptado)."");
            exit; // Adicione isso para garantir que o script PHP pare de ser executado após o redirecionamento
        }
    }
    
?>
