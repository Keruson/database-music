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
            <form id="taskForm" class="row g-3 p-3">
                <div class="col-md-6">
                    <label>Título</label>
                    <input type="text" class="form-control" id="taskInput" required>
                </div>

                <div class="col-md-6">
                    <label>Gênero</label>
                    <input type="text" class="form-control" id="taskInput" required>
                </div>

                <div class="col-md-6">
                    <label>Artista</label>
                    <input type="text" class="form-control" id="taskInput" required>
                </div>

                <div class="col-md-6">
                    <label>Gravadora</label>
                    <input type="text" class="form-control" id="taskInput" required>
                </div>

                <div class="col-md-3">
                    <label>Quantidade</label>
                    <input type="number" class="form-control" id="taskInput" required>
                </div>

                <div class="col-md-3">
                    <label>Valor (R$)</label>
                    <input type="number" class="form-control" id="taskInput" required>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-1">
                        <button type="submit" class="btn btn-success w-100">Salvar</button>
                    </div>

                    <div class="col-md-1">
                        <a href="index'php" class="btn btn-secondary w-100">Voltar</a>
                    </div>
                </div>
                
            </form>
        </div>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>