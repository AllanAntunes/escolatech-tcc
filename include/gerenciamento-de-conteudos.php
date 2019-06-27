<?php
include 'banco-de-dados.php';

// Adicionar conteúdo
if($_POST['tarefa'] == 'adicionarConteudo') {
    if($_POST['tipo'] == 1) {
        $idCapitulo = $_POST['idCapitulo'];
        $tipo = $_POST['tipo'];
        $posicao = $_POST['posicao'];

        $posicaoMenosUm = $posicao - 1;

        if(mysqli_query($conexao, 'UPDATE conteudo SET posicao = posicao + 1 WHERE posicao > ' . $posicaoMenosUm . ' AND idCapitulo = ' . $idCapitulo)) {
            if(mysqli_query($conexao, "INSERT INTO conteudo (idCapitulo, tipo, posicao) VALUES ($idCapitulo, $tipo, $posicao)")) {
                $SQLconteudo = mysqli_query($conexao, 'SELECT id FROM conteudo ORDER BY id DESC LIMIT 1');
                if(mysqli_num_rows($SQLconteudo) == 1) {
                    $conteudo = mysqli_fetch_assoc($SQLconteudo);

                    $idConteudo = $conteudo['id'];
                    $titulo = $_POST['titulo'];
                    $anexoURL = $_POST['anexoURL'];
                    $conteudo = $_POST['conteudo'];
                    $idVideo = $_POST['idVideo'];
        
                    if(mysqli_query($conexao, "INSERT INTO topico (idConteudo, titulo, anexoURL, conteudo, idVideo) VALUES ($idConteudo, '$titulo', '$anexoURL', '$conteudo', $idVideo)")) {
                        echo 'sucesso';
                    }
                }
            }
        }
    } else if($_POST['tipo'] == 2) {

    } else {
        echo 'Ocorreu um erro.';
    }
}

// Editar conteúdo
if($_POST['tarefa'] == 'editarConteudo') {
    if($_POST['tipo'] == 1) {
        $idCapitulo = $_POST['idCapitulo'];
        $idConteudo = $_POST['idConteudo'];
        $tipo = $_POST['tipo'];
        $posicao = $_POST['posicao'];

        $SQLconteudo = mysqli_query($conexao, 'SELECT posicao FROM conteudo WHERE id = ' . $_POST['idConteudo']);
        if(mysqli_num_rows($SQLconteudo) == 1) {
            $conteudo = mysqli_fetch_assoc($SQLconteudo);

            if($posicao < $conteudo['posicao']) {
                $posicaoMenosUm = $posicao - 1;

                mysqli_query($conexao, 'UPDATE conteudo SET posicao = posicao + 1 WHERE posicao > ' . $posicaoMenosUm . ' AND posicao < ' . $conteudo['posicao'] . ' AND idCapitulo = ' . $idCapitulo);
            } else {
                if($posicao > $conteudo['posicao']) {
                    $posicaoMaisUm = $posicao + 1;
    
                    mysqli_query($conexao, 'UPDATE conteudo SET posicao = posicao - 1 WHERE posicao > ' . $conteudo['posicao'] . ' AND posicao < ' . $posicaoMaisUm . ' AND idCapitulo = ' . $idCapitulo);
                }
            }

            if(mysqli_query($conexao, 'UPDATE conteudo SET posicao = ' . $posicao . ' WHERE id = ' . $idConteudo)) {
                $titulo = $_POST['titulo'];
                $anexoURL = $_POST['anexoURL'];
                $conteudo = $_POST['conteudo'];
                $idVideo = $_POST['idVideo'];
    
                if(mysqli_query($conexao, "UPDATE topico SET titulo = '$titulo', anexoURL = '$anexoURL', conteudo = '$conteudo', idVideo = $idVideo WHERE idConteudo = $idConteudo")) {
                    echo 'sucesso';
                }
            }
        }
    } else if($_POST['tipo'] == 2) {

    } else {
        echo 'Ocorreu um erro.';
    }
}

// Excluir conteúdo
if($_POST['tarefa'] == 'excluirConteudo') {
    if($_POST['tipo'] == 1) {
        $idCapitulo = $_POST['idCapitulo'];
        $idConteudo = $_POST['idConteudo'];
        $posicao = $_POST['posicao'];

        if(mysqli_query($conexao, 'DELETE FROM conteudo WHERE id = ' . $idConteudo)) {
            if(mysqli_query($conexao, 'UPDATE conteudo SET posicao = posicao - 1 WHERE posicao > ' . $posicao . ' AND idCapitulo = ' . $idCapitulo)) {
                echo 'sucesso';
            }
        }
    } else if($_POST['tipo'] == 2) {

    } else {
        echo 'Ocorreu um erro.';
    }
}
?>