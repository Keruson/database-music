<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dbMusica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body { background-color: #f8f9fa;}
        .main-container {margin-top: 30px; max-width: 95%;}
        .card { border: none; border-radius: 6px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);}
        .navbar {height: 60px;}
        .nav-link {margin-right: 30px;}
        .btn-sm {padding: 3px 8px;}
    </style>
</head>


<body>
    <nav class = "navbar navbar-expand-lg navbar-dark bg-primary px-3">
            <span class = "navbar-brand mb-0 h1" style = "margin-left:20px"> dbMusica</span>

            <div class="ms-auto d-flex">
                <a class = "nav-link text-white-50" href="index.php">Discos</a>
                <a class = "nav-link text-white-50" href="cad-disco.php">Cadastrar Disco</a>
                <a class = "nav-link text-light active" href="#">Artistas</a>
                <a class = "nav-link text-white-50" href="cad-artista.php">Cadastrar Artistas</a>
            </div>
    </nav>

    <div class="container main-container">

        <div class = "row g-3">
            <div class = "col-md-11">
                <h4>Artistas Cadastrados</h4>
            </div>
        </div>

<?php
    

    //VARIAVEIS DO BANCO DE DADOS
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $conexao = mysqli_connect($servidor, $usuario, $senha, 'dbmusica');

    //SISTEMA DE PÁGINAÇÃO - PARTE 1
    $registrosPorPagina = 10;
    $paginaAtual = isset($_GET['pagina'])? (int)$_GET['pagina'] : 1;
    if($paginaAtual < 1) { $paginaAtual = 1; }
    $offset = ($paginaAtual - 1) * $registrosPorPagina;
    $sqlTotal = "SELECT COUNT(*) as Total FROM tbartista WHERE IsDeleted = 0";
    $resultadoTotal = mysqli_query($conexao, $sqlTotal);
    $totalRegistros = mysqli_fetch_assoc($resultadoTotal)['Total'];
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    //BOTÃO EXCLUIR
    if(isset($_POST['btnExcluir']))
    {
        $codArt = (int)$_POST['codArt'];

        $comando = "UPDATE tbartista
                    SET IsDeleted = 1
                    WHERE CodArt = $codArt";

        mysqli_query($conexao, $comando);

        header("Location: artistas.php");
        exit();
    }

    //BOTÃO EDITAR
    if(isset($_POST['btnEditar']))
    {
        $codArt = (int)$_POST['codArtEditar'];

        $novoNome = mysqli_real_escape_string(
            $conexao,
            $_POST['novoNome']
        );

        $comando = "
            UPDATE tbartista
            SET Nome = '$novoNome'
            WHERE CodArt = $codArt
        ";

        mysqli_query($conexao, $comando);

        header('Location: artistas.php');
        exit();
    }

    //TABELA
    $comando = "SELECT
                    a.CodArt,
                    a.Nome,
                    COUNT(d.CodDisco) AS QuantidadeDiscos
                FROM tbartista a 
                LEFT JOIN tbdisco d 
                    ON a.CodArt = d.CodArt 
                WHERE 
                    a.IsDeleted = 0
                GROUP BY a.CodArt
                LIMIT $registrosPorPagina
                OFFSET $offset";

    $resultado = mysqli_query($conexao, $comando);

    if($resultado == false)
    {
        echo "<h4>Erro: ".mysqli_error($conexao)."</h4>";
    }
    else {
        if(mysqli_num_rows($resultado) < 1)
        {
            echo "<p>Não Existem Artistas no Banco de Dados</p>";
        }
        else
        {
            echo "<div class='card p-3 mt-3'>
                    <div class='table-responsive'>
                        <table class='table table-striped alight-middle'>
                            <thead class='table-dark'>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Discos</th>
                                    <th class='text-center'>Ações</th>
                                </tr>
                            </thead>
                            
                            <tbody id='taskTableBody'>";

            while($linha = mysqli_fetch_row($resultado))
            {
                echo "<tr>
                        <td>$linha[0]</td>
                        <td>$linha[1]</td>
                        <td>$linha[2]</td>
                        <td class='text-center'>
                                    <button
                                        class='btn btn-warning btn-sm btnEditar'
                                        data-id='$linha[0]'
                                        data-nome='" . htmlspecialchars($linha[1], ENT_QUOTES) . "'
                                        data-bs-toggle='modal'
                                        data-bs-target='#editModal'>
                                        Editar
                                    </button>            
                                    
                                    <button
                                        class='btn btn-danger btn-sm btnExcluir'
                                        data-id='$linha[0]'
                                        data-nome='" . htmlspecialchars($linha[1], ENT_QUOTES) . "'
                                        data-bs-toggle='modal'
                                        data-bs-target='#deleteModal'>
                                        Excluir
                                    </button>
                                    
                                    
                                    
                                </div>
                        </td>
                    </tr>";
            }
        }
    }
    echo "</tbody> </table> </div> </div>";


    //SISTEMA DE PÁGINAÇÃO - PARTE 2
    echo "<nav class='mt-3'>";
    echo "<ul class='pagination justify-content-center'>";

    if($paginaAtual > 1)
    {
        echo "
        <li class='page-item'>
            <a class='page-link'
            href='?pagina=".($paginaAtual-1)."'>
            Anterior
            </a>
        </li>";
    }

    for($i = 1; $i <= $totalPaginas; $i++)
    {
        $active =
            ($i == $paginaAtual)
            ? "active"
            : "";

        echo "
        <li class='page-item $active'>
            <a class='page-link'
            href='?pagina=$i'>
            $i
            </a>
        </li>";
    }

    if($paginaAtual < $totalPaginas)
    {
        echo "
        <li class='page-item'>
            <a class='page-link'
            href='?pagina=".($paginaAtual+1)."'>
            Próxima
            </a>
        </li>";
    }

    echo "</ul>
        </nav>
    </div>";

?>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelectorAll('.btnExcluir').forEach(botao => {

            botao.addEventListener('click', function() {

                const id = this.dataset.id;
                const nome = this.dataset.nome;

                document.getElementById('codArt').value = id;
                document.getElementById('nomeArtista').textContent = nome;
            });
        });

        document.querySelectorAll('.btnEditar').forEach(botao => {

            botao.addEventListener('click', function() {

                const id = this.dataset.id;
                const nome = this.dataset.nome;

                document.getElementById('codArtEditar').value = id;
                document.getElementById('novoNome').value = nome;
            });
        });
    </script>

    <!-- MODAL DE DELETAR -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class = "modal-title" style="padding-bottom: 20px;"><i class="bi bi-globe"></i> localhost</h6>
                    <p class="mb-4"> Deseja realmente excluir o artista <strong id="nomeArtista"></strong>?</p>
                    <div class="text-end">
                        <form method="POST">
                            <input type="hidden" name="codArt" id="codArt">
                            <button type="submit" name="btnExcluir" class="btn btn-primary btn-sm"> OK </button>
                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"> Cancelar </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DE EDITAR -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h6 class = "modal-title" style="padding-bottom: 20px;"><i class="bi bi-globe"></i> localhost</h6>
                    <form method="POST">
                        <input type="hidden" name="codArtEditar" id="codArtEditar">
                        <label class="form-label"> Renomear Artista: </label>
                        <input type="text" class="form-control" name="novoNome" id="novoNome" required>
                        <div class="text-end mt-3">
                            <button type="submit" name="btnEditar" class="btn btn-primary btn-sm"> Salvar </button>
                            <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal"> Cancelar </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>