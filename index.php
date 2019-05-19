<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/global/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/global/assets/css/solid.min.css">
    <link rel="stylesheet" href="/global/assets/css/brands.min.css">
    <link rel="stylesheet" href="/global/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="/global/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
    <title>EscolaTech</title>
    <?php
    include 'global/include/banco-de-dados.php';

    if(isset($_GET['slug']) && $_GET['slug'] != 'pagina-inicial') { ?>
    <link rel="stylesheet" href="/aberto/assets/css/<?php echo $_GET['slug']; ?>.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm">
        <div class="container">
            <a href="/" class="navbar-brand" style="color: #1166DD;">
                <i class="fas fa-terminal mr-1"></i><b>Escola</b>Tech
            </a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="/cursos/" class="nav-link">Cursos</a></li>
            </ul>
            <a href="/login/" class="btn btn-outline-primary mr-2">Login</a>
            <a href="/cadastre-se/" class="btn btn-primary">Cadastre-se</a>
        </div>
    </nav>
        <?php
        if(file_exists('aberto/' . $_GET['slug'] . '.html')) {
            include 'aberto/' . $_GET['slug'] . '.html';
        } else {
            include 'global/404.html';
        }
    } else {
        include 'aberto/pagina-inicial.html';
    } ?>
    <script src="/global/assets/js/jquery-3.4.0.min.js"></script>
    <script src="/global/assets/js/popper.min.js"></script>
    <script src="/global/assets/js/bootstrap.min.js"></script>
</body>
</html>