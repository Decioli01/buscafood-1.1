<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Estabelecimentos - BuscaFood®</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <!-- biblioteca de icones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
        <!-- CSS comum -->
    <link rel="stylesheet" href="./css/listarestab.css"> 
</head>
<body>
    <?php 
        include_once('./acoes/conexao.php');

        if(!empty($_GET['busca']) and !empty($_GET['cidade'])){
            $data = $_GET['busca'];
            $cidade = $_GET['cidade'];
                    //realiza o select com o que foi inserido no campo de busca
            $sql = "SELECT * FROM estabelecimentos e
                    INNER JOIN cidades c
                    ON c.cidId = e.cid_Id
                    WHERE e.estNome LIKE '%$data%' 
                        AND e.cid_Id = $cidade
                    ORDER BY e.estNome";
                    //realiza o select trazendo o nome e a logo do estabelecimento
        }
        if (empty($_GET['cidade'])){
            $data = $_GET['busca'];
            $sql = "SELECT * FROM estabelecimentos e
                    INNER JOIN cidades c
                    ON c.cidId = e.cid_Id
                    WHERE e.estNome LIKE '%$data%'";
        }
        else{
                    //realiza o select dos produtos assim que o usuario loga
            $sql = "SELECT * FROM estabelecimentos e
                    INNER JOIN cidades c
                    ON c.cidId = e.cid_Id
                    ORDER BY e.cid_Id, e.estNome";

        }
        $consulta = mysqli_query($conn, $sql);
    ?>
    <header class="header">
        <div>
            <a href="../index.html" class="logo">
                <img src="./images/Logo.svg" alt="">
            </a>
        </div>
        
        <div id="logout" >
            <a href="./acoes/logout.php">Logout</a>
        </div>
    </header>
    <section class="content">
        <h1 id="title">Listagem de estabelecimentos</h1>
        <div class="pesquisa">
                <input type="text" id="campo-busca" name="texto-busca" placeholder="Buscar por estabelecimento...">

                <select name="cidade" id="location">
                    <option value="" selected hidden disabled>Cidade...</option>
                    <option value="1">Tupã</option>
                </select>

                <button onclick="searchData()" id="searchestab" name="" class="btn btn-primary" alt="Pesquisar">
                    <i class="fa-solid fa-search"></i>
                </button>

                <a class="btn btn-success" id="addestab" href="cadestab.html">
                    <i class="fa-solid fa-plus"></i>
                </a>
        </div>
        <br>
        <div class="m-8 tabelaEstab">
            <table class="table text-black table-bg">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Excluir</th>
                    </tr>
                </<thead>
                <tbody>
                    <?php 
                        while ($resultados = mysqli_fetch_array($consulta)){
                            echo "<tr>";
                            '<input type="hidden" id="produto" value="'.$resultados['estId'].'">';
                            echo "<td class='tamanhoMax'><a href='listarprod.php?id_estab=".$resultados['estId']."'><p>".$resultados['estNome']."</p></a></td>";
                            echo "<td class='tamanhoMax''><p>".$resultados['estEndereco']."</p></td>";   
                            echo "<td>".$resultados['cidNome']."</td>";
                            echo "<td><img style='width: 100px; height: 50px;' src='./images/estabelecimentos/".$resultados['estLogo']."'></td>";
                            echo "<td>
                                    <a class='btn btn-sm btn-warning' href='atualizaestab.php?id_estab=".$resultados['estId']."'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                        <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                        <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z'/>
                                        </svg>
                                    </a>
                                </td>";
                            echo "<td>
                                <a class='btn btn-sm btn-danger' id='deleteBtn' onClick='apaga(".$resultados['estId'].")'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' color='black' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                                    <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z'/>
                                    </svg>
                                </td>";   
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    
</body>

<script> //script do campo de busca e alert de confirmação de exclusao
        var search = document.getElementById('campo-busca');
        var cidade = document.getElementById('location');

        function searchData(){
            window.location = 'listarestab.php?busca='+search.value+'&cidade='+cidade.value;
        }
        search.addEventListener("keydown", function(event){
            if(event.key == "Enter"){
                searchData();
            }
        });
        
        function apaga(idEstab){
            if (confirm("Você deseja mesmo apagar este estabelecimento?")) {
                location.href = './acoes/deleteEstab.php?id_estab='+idEstab
            }
            alert("Estabelecimento excluído com sucesso!")
        }

    </script>
</html>