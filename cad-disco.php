<?php
    //VARIAVEIS DO BANCO DE DADOS
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $conexao = mysqli_connect($servidor, $usuario, $senha, 'dbmusica');

    //BOTÃO DE SALVAR
    if(isset($_POST['btnSalvar']))
    {
        $Titulo = mysqli_real_escape_string($conexao, $_POST['titleInput']);
        $Genero = mysqli_real_escape_string($conexao, $_POST['genreInput']);
        $CodArt = (int)$_POST['artistasValue'];
        $Gravadora = mysqli_real_escape_string($conexao, $_POST['recordInput']);
        $Quantidade = (int) $_POST['quantInput'];
        $Valor = (float)$_POST['valInput'];

        $comando = "
            INSERT INTO tbdisco (Titulo, Genero, CodArt, Gravadora, Quantidade, Valor, IsDeleted) 
            VALUES ('$Titulo', '$Genero', '$CodArt', '$Gravadora', '$Quantidade', '$Valor', 0)";


        if(mysqli_query($conexao, $comando))
        {
            header('Location: cad-disco.php?sucesso=1');
            exit();
        }
        else
        {
            echo mysqli_error($conexao);
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dbMusica</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa;}
        .main-container {margin-top: 30px;max-width: 95%;}
        .card { border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);}
        .navbar {height: 60px;}
        .nav-link {margin-right: 30px;}
    </style>
</head>

<body>
    <nav class = "navbar navbar-expand-lg navbar-dark bg-primary px-3">
            <span class = "navbar-brand mb-0 h1" style = "margin-left:20px"> dbMusica</span>

            <div class="ms-auto d-flex">
                <a class = "nav-link text-white-50" href="index.php">Discos</a>
                <a class = "nav-link text-light active" href="#">Cadastrar Disco</a>
                <a class = "nav-link text-white-50" href="artistas.php">Artistas</a>
                <a class = "nav-link text-white-50" href="cad-artista.php">Cadastrar Artistas</a>
            </div>
    </nav>

    <div class="container main-container">
        <div class="card mt-4">
            <div class="card-header"><b style="font-size: 18px;">Novo Disco</b></div>
            <form id="taskForm" method="POST" class="row g-3 p-3">
                <div class="col-md-6">
                    <label>Título</label>
                    <input type="text" class="form-control" name="titleInput" id="titleInput" required>
                </div>

                <div class="col-md-6">
                    <label>Gênero</label>
                    <input type="text" class="form-control" name="genreInput" id="genreInput" required>
                </div>

                <div class="col-md-6">
                    <label>Artista</label>
                    <select class="form-control" name="artistasValue" id="artistasValue">
                        <?php
                            $comando = "SELECT CodArt, Nome FROM tbartista WHERE IsDeleted = 0";
                            $resultado = mysqli_query($conexao, $comando);

                            if($resultado == false)
                            {
                                echo "<h4>Erro: ".mysqli_error($conexao)."</h4>";
                            }
                            else 
                            {
                                if(mysqli_num_rows($resultado) < 1)
                                {
                                    echo "<p>Não Existem Artistas no Banco de Dados</p>";
                                }
                                else
                                {
                                    while($linha = mysqli_fetch_row($resultado))
                                    {
                                        echo "<option value=$linha[0]>$linha[1]</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label>Gravadora</label>
                    <input type="text" class="form-control" name="recordInput" id="recordInput" required>
                </div>

                <div class="col-md-3">
                    <label>Quantidade</label>
                    <input type="number" class="form-control" name="quantInput" id="quantInput" required>
                </div>

                <div class="col-md-3">
                    <label>Valor (R$)</label>
                    <input type="number" class="form-control" name="valInput" required>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-1">
                        <button type="submit" name="btnSalvar" class="btn btn-success w-100">Salvar</button>
                    </div>

                    <div class="col-md-1">
                        <a href="index.php" class="btn btn-secondary w-100">Voltar</a>
                    </div>
                </div>
                
            </form>
        </div>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <?php if(isset($_GET['sucesso'])): ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {

            const modal = new bootstrap.Modal(
                document.getElementById('successModal')
            );

            modal.show();

        });
        </script>
        <?php endif; 
    ?>

    <div class="modal fade" id="successModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header"> 
                    <h5 class="modal-title"> Operação concluída </h5>
                </div>

                <div class="modal-body"> 
                    Disco cadastrado com sucesso! 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> OK </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>