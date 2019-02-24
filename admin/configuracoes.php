<?php

$servidor = 'localhost';
$usuario = 'root';
$senha = null;
$banco = 'escolaenem';

$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

mysqli_set_charset($conexao, "utf8");
?>