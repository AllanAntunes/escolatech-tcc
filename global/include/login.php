<?php
if(isset($_POST['email']) && isset($_POST['senha'])) {
    include 'banco-de-dados.php';
    
    $SQL = mysqli_query($conexao, 'SELECT email, senha, tipo FROM usuario WHERE email = ' . "'" . $_POST['email'] . "'" . ' AND senha = ' . "'" . $_POST['senha'] . "'");
    if(mysqli_num_rows($SQL) == 1) {
        $retorno['confere'] = TRUE;

        $usuario = mysqli_fetch_assoc($SQL);
        $retorno['tipo'] = (int) $usuario['tipo'];

        session_start();
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['senha'] = $_POST['senha'];
        $_SESSION['tipo'] = (int) $usuario['tipo'];
    } else {
        $retorno['confere'] = FALSE;
    }
}
echo json_encode($retorno);
?>