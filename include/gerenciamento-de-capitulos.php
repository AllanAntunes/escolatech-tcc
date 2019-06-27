<?php
include 'banco-de-dados.php';

// Adicionar capítulo
if($_POST['tarefa'] == 'adicionarCapitulo') {
    $idCurso = $_POST['idCurso'];
    $titulo = $_POST['titulo'];
    $posicao = $_POST['posicao'];

    $posicaoMenosUm = $posicao - 1;

    if(mysqli_query($conexao, 'UPDATE capitulo SET posicao = posicao + 1 WHERE posicao > ' . $posicaoMenosUm)) {
        if(mysqli_query($conexao, 'INSERT INTO capitulo (idCurso, titulo, posicao) VALUES ' . "($idCurso, '$titulo', $posicao)")) {
            echo 'sucesso';
        }
    }
}

// Editar capítulo
if($_POST['tarefa'] == 'editarCapitulo') {
    $idCapitulo = $_POST['idCapitulo'];
    $titulo = $_POST['titulo'];
    $posicao = $_POST['posicao'];

    $SQLcapitulo = mysqli_query($conexao, 'SELECT posicao FROM capitulo WHERE id = ' . $_POST['idCapitulo']);
    if(mysqli_num_rows($SQLcapitulo) == 1) {
        $capitulo = mysqli_fetch_assoc($SQLcapitulo);

        if($posicao < $capitulo['posicao']) {
            $posicaoMenosUm = $posicao - 1;

            mysqli_query($conexao, 'UPDATE capitulo SET posicao = posicao + 1 WHERE posicao > ' . $posicaoMenosUm . ' AND posicao < ' . $capitulo['posicao']);
        } else {
            if($posicao > $capitulo['posicao']) {
                $posicaoMaisUm = $posicao + 1;

                mysqli_query($conexao, 'UPDATE capitulo SET posicao = posicao - 1 WHERE posicao > ' . $capitulo['posicao'] . ' AND posicao < ' . $posicaoMaisUm);
            }
        }

        if(mysqli_query($conexao, "UPDATE capitulo SET titulo = '$titulo', posicao = $posicao WHERE id = $idCapitulo")) {
            echo 'sucesso';
        }
    }
}

// Excluir capítulo
if($_POST['tarefa'] == 'excluirCapitulo') {
    $idCapitulo = $_POST['idCapitulo'];
    $posicao = $_POST['posicao'];
    
    if(mysqli_query($conexao, 'DELETE FROM capitulo WHERE id = ' . $idCapitulo)) {
        if(mysqli_query($conexao, 'UPDATE capitulo SET posicao = posicao - 1 WHERE posicao > ' . $posicao)) {
            echo 'sucesso';
        }
    }
}
?>