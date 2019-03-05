<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/solid.min.css">
    <link rel="stylesheet" href="/css/brands.min.css">
    <link rel="stylesheet" href="/css/fontawesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
    <?php include('admin/configuracoes.php'); ?>
    <title>EscolaEnem</title>
</head>
<body>
    <?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $SQL = mysqli_query($conexao, "SELECT conteudo FROM conteudo WHERE id = '$id'");
        if(mysqli_num_rows($SQL) >= 1){
            $linha = mysqli_fetch_assoc($SQL);
            echo $linha['conteudo'];
        } else{
            include('404.php');
        }
    } elseif(isset($_GET['disciplina'])){
        $disciplina = $_GET['disciplina'];
        $SQL = mysqli_query($conexao, "SELECT nome FROM disciplina WHERE nome = '$disciplina'");
        if(mysqli_num_rows($SQL) >= 1){
            include('paginacao.php');
        }
    } else{ ?>
    <div class="home-principal">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a href="/" class="navbar-brand mr-auto text-white">
                    <i class="fas fa-book mr-1"></i><b>Escola</b>Enem
                </a>
                <a href="#" class="btn btn-outline-white mr-2">Login</a>
                <a href="#" class="btn btn-white text-black">Cadastre-se</a>
            </div>
        </nav>
        <div class="jumbotron jumbotron-fluid home-principal-jumbotron text-white shadow-sm mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-6">
                        <h1 class="headline mb-5">O EscolaEnem descomplica a sua vida de estudante</h1>
                        <button type="button" class="btn btn-light mr-2" data-toggle="modal" data-target="#cadastre-se"><b>Comece gratuitamente</b></button>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    </div>
    <?php } ?>
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>