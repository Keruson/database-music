<?php 
    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $conexao = mysqli_connect($servidor, $usuario, $senha, 'dbmusica');

    if(isset($_POST['btnSalvar']))
    {
        $Nome = mysqli_real_escape_string(
            $conexao,
            $_POST['inputNome']
        );

        $comando = "
            INSERT INTO tbartista (Nome, IsDeleted) VALUES ('$Nome', 0)";

        mysqli_query($conexao, $comando);

        header('Location: cad-artista.php?sucesso=1');
        exit();
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
                <a class = "nav-link text-white-50" href="cad-disco.php">Cadastrar Disco</a>
                <a class = "nav-link text-white-50" href="artistas.php">Artistas</a>
                <a class = "nav-link text-light active" href="#">Cadastrar Artistas</a>
            </div>
    </nav>

    <div class="container main-container">
        <div class="card mt-4">
            <div class="card-header"><b style="font-size: 18px;">Novo Artista</b></div>
            <form id="taskForm" method="POST" class="row g-3 p-3">
                <div class="col-md-8">
                    <label>Nome</label>
                    <input type="text" class="form-control" id="inputNome" name="inputNome" required>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-1">
                        <button type="submit" name="btnSalvar" class="btn btn-success w-100">Salvar</button>
                    </div>

                    <div class="col-md-1">
                        <a href="artistas.php" class="btn btn-secondary w-100">Voltar</a>
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
                    Artista cadastrado com sucesso! 
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> OK </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>