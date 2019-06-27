<?php
if(isset($_POST['email'], $_POST['senha'])) {
    include '../include/banco-de-dados.php';
    
    $SQL = mysqli_query($conexao, 'SELECT * FROM usuario WHERE email = ' . "'" . $_POST['email'] . "'" . ' AND senha = ' . "'" . $_POST['senha'] . "'");
    if(mysqli_num_rows($SQL) == 1) {
        $retorno['confere'] = TRUE;

        $usuario = mysqli_fetch_assoc($SQL);
        $retorno['tipo'] = (int) $usuario['tipo'];

        session_start();
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];

        $nomeReduzido = explode(' ', $usuario['nome']);
        $nomeReduzido = $nomeReduzido[0] . ' ' . $nomeReduzido[1];

        $_SESSION['nomeReduzido'] = $nomeReduzido;
        
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['senha'] = $usuario['senha'];
        $_SESSION['URLFotoPerfil'] = $usuario['fotoPerfil'];
        $_SESSION['tipo'] = (int) $usuario['tipo'];
    } else {
        $retorno['confere'] = FALSE;
    }
}
echo json_encode($retorno);
?>