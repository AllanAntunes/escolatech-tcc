<?php
include 'include/banco-de-dados.php';

session_start();

if(((isset($_GET['diretorio'])) && !$_SESSION) || (isset($_GET['diretorio']) && $_GET['diretorio'] == 'admin' && $_SESSION['tipo'] == 1)) {
    header('Location: https://escolatech.net/');
}

if(isset($_GET['slug'])) {
    $slug = $_GET['slug'];
} else {
    if(isset($_GET['diretorio'])) {
        $slug = 'cursos';
    } else {
        $slug = 'pagina-inicial';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <?php if(!isset($_GET['diretorio'])) { ?>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <?php } ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <?php if(isset($_GET['diretorio'])) { ?>
    <link rel="stylesheet" href="/assets/css/atlantis.min.css">
    <link rel="stylesheet" href="/assets/css/summernote-bs4.css">
    <?php } ?>
    <link rel="stylesheet" href="/assets/css/solid.min.css">
    <link rel="stylesheet" href="/assets/css/brands.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome.min.css">
    <?php if(isset($_GET['diretorio'])) { ?>
    <link rel="stylesheet" href="/logado/<?php echo $_GET['diretorio']; ?>/css/<?php echo $slug; ?>.css">
    <link rel="stylesheet" href="/assets/css/logado.css">
    <?php } else { ?>
    <link rel="stylesheet" href="/aberto/css/<?php echo $slug; ?>.css">
    <link rel="stylesheet" href="/assets/css/aberto.css">
    <?php } ?>
    <link rel="stylesheet" href="/assets/css/global.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">
    <title>EscolaTech</title>
</head>
<body>
    <?php include (isset($_GET['diretorio'])) ? 'logado/index.php' : 'aberto/index.php'; ?>
	<script src="/assets/js/jquery-3.4.1.min.js"></script>
	<script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>
    <?php if(isset($_GET['diretorio'])) { ?>
    <script src="/assets/js/atlantis.min.js"></script>
    <script src="/assets/js/summernote-bs4.min.js"></script>
    <script src="/assets/js/summernote-pt-BR.min.js"></script>
    <script src="/logado/<?php echo $_GET['diretorio']; ?>/js/<?php echo $slug; ?>.js"></script>
    <script src="/assets/js/logado.js"></script>
    <?php } else { ?>
    <script src="/aberto/js/<?php echo $slug; ?>.js"></script>
    <script src="/assets/js/aberto.js"></script>
    <?php } ?>
    <script src="/assets/js/global.js"></script>
</body>
</html>