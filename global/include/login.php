<?php
if(isset($_POST['email']) && isset($_POST['senha'])) {
    $conexao = mysqli_connect('localhost', 'root', NULL, 'escolatech');
    mysqli_set_charset($conexao, 'utf8');

    $SQL = mysqli_query($conexao, 'SELECT email, senha FROM usuario WHERE email = ' . "'" . $_POST['email'] . "'" . ' AND senha = ' . "'" . $_POST['senha'] . "'");
    if(mysqli_num_rows($SQL) == 1) {
        echo 1;
    } else {
        echo 0;
    }
}
?>