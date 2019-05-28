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
    <?php
	if(isset($_GET['slug']) && file_exists($_GET['slug'] . '.html')) {
		echo '<link rel="stylesheet" href="/aberto/assets/css/' . $_GET['slug'] . '.css"';
	}
	?>
    <link rel="stylesheet" href="/global/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
    <title>EscolaTech</title>
    <?php
    if(isset($_GET['slug'])) {
    ?>
    <link rel="stylesheet" href="/aberto/assets/css/<?php echo $_GET['slug']; ?>.css">
</head>
<body>
    <?php
        if($_GET['slug'] != 'pagina-inicial' && $_GET['slug'] != 'login') {
    ?>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a href="/" class="navbar-brand" style="color: #1166DD;">
                <i class="fas fa-terminal mr-1"></i><b>Escola</b>Tech
            </a>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a href="/cursos/" class="nav-link"><i class="fas fa-bars mr-2"></i>Cursos</a></li>
            </ul>
            <a href="/login/" class="btn btn-outline-primary mr-2">Login</a>
            <a href="/planos/" class="btn btn-primary">Matricule-se</a>
        </div>
    </nav>
    <?php
        }
        if(file_exists('aberto/' . $_GET['slug'] . '.html')) {
            include 'aberto/' . $_GET['slug'] . '.html';
        } else {
            include 'global/404.html';
        }
    } else {
    ?>
    <link rel="stylesheet" href="/aberto/assets/css/pagina-inicial.css">
</head>
<body>
    <?php
        include 'aberto/pagina-inicial.html';
    }
    ?>
    <script src="/global/assets/js/jquery-3.4.0.min.js"></script>
    <script src="/global/assets/js/popper.min.js"></script>
    <script src="/global/assets/js/bootstrap.min.js"></script>
    <?php
	if(isset($_GET['slug']) && file_exists($_GET['slug'] . '.html')) {
		echo '<script src="/aberto/assets/js/' . $_GET['slug'] . '.js"></script>';
	}
	?>
</body>
</html>