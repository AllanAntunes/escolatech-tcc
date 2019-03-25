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
    <link rel="stylesheet" href="/css/summernote-bs4.css">
    <link rel="stylesheet" href="/css/dataTables.bootstrap4.min.css">
    <?php include('configuracoes.php'); ?>
    <title>EscolaEnem</title>
    <script src="/js/jquery-3.3.1.min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/summernote-bs4.min.js"></script>
    <script src="/js/summernote-pt-BR.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
    <div class="sticky-top">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark shadow-sm">
            <div class="container">
                <button class="navbar-toggler border-0 mr-auto" type="button" data-toggle="collapse" data-target="#menu">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="/admin/" class="navbar-brand mr-auto mr-md-3 text-light">
                    <i class="fas fa-book mr-1"></i><b>Escola</b>Enem
                </a>
                <button class="navbar-toggler border-0 ml-2" type="button" data-toggle="collapse" data-target="#area-de-logon">
                    <i class="fas fa-user-circle"></i>
                </button>
                <div class="collapse navbar-collapse mr-auto" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/admin/conteudo/" class="nav-link" style="padding-right:0;"><i class="fas fa-edit mr-2"></i>Conteúdo</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"></a>
                            <div class="dropdown-menu">
                                <a href="/admin/disciplinas/" class="dropdown-item">Disciplinas</a>
                                <a href="/admin/materias/" class="dropdown-item">Matérias</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/midia/" class="nav-link"><i class="fas fa-images mr-2"></i>Mídia</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/usuarios/" class="nav-link"><i class="fas fa-users mr-2"></i>Usuários</a>
                        </li>
                    </ul>
                </div>
                <div class="collapse navbar-collapse" id="area-de-logon">
                    <a href="/" target="_blank" class="btn btn-light"><i class="fas fa-globe-americas mr-2"></i>Visitar site</a>
                </div>
            </div>
        </nav>
    <?php if(isset($_GET['slug']) && $_GET['slug'] != 'conteudo' && $_GET['slug'] != 'disciplinas' && $_GET['slug'] != 'materias' && $_GET['slug'] != 'editar' && $_GET['slug'] != 'midia' && $_GET['slug'] != 'usuarios'){echo "</div>";} ?>
    <?php
    if(isset($_GET['slug'])){
        if(file_exists($_GET['slug'] . '.php')){
            include $_GET['slug'] . '.php';
        } else{
            include '../404.php';
        }
    } else{ ?>
    <?php } ?>
</body>
</html>