<?php
    session_start();
                    //verifica o email e senha
    if(isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['senha'])){
         
        include_once('conexao.php');
        $usuario = $_POST['usuario'];
        $estSenha = $_POST['senha'];
                    //apos verificar senha e email faz-se o select no banco
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND senha = $estSenha";
        $res = mysqli_query($conn, $sql);
                
        $resultado = mysqli_fetch_array($res);

        if(mysqli_num_rows($res) < 1){
                //caso nao tenha se encerra a sessao e volta ao login
            unset($_SESSION['usuario']);
            unset($_SESSION['senha']);
            header('Location: ../index.html');
        }
        else{
                    //caso exista, inicia a sessao e  redireciona para tela de listagem
            $_SESSION['usuario'] = $usuario;
            $_SESSION['estSenha'] = $estSenha;
            header('Location: ../listarestab.php');
        }
        
    }
    else{
            
        header('Location: ../index.html');//caso alguma divergencia seja encontrada, redireciona para  o login
    }
?>