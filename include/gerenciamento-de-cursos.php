<?php
include 'banco-de-dados.php';

if(isset($_POST['tarefa'])) {
    
    // Adicionar curso
    if($_POST['tarefa'] == 'adicionarCurso') {
        $titulo = $_POST['titulo'];
        $posicao = $_POST['posicao'];
        $cor = $_POST['cor'];
        $imagemURL = $_POST['imagemURL'];

        $posicaoMenosUm = $posicao - 1;

        if(mysqli_query($conexao, 'UPDATE curso SET posicao = posicao + 1 WHERE posicao > ' . $posicaoMenosUm)) {
            if(mysqli_query($conexao, 'INSERT INTO curso (titulo, posicao, cor, imagemURL) VALUES ' . "('$titulo', $posicao, '$cor', '$imagemURL')")) {
                echo 'sucesso';
            }
        }
    }

    // Editar curso
    if($_POST['tarefa'] == 'editarCurso') {
        $idCurso = $_POST['idCurso'];
        $titulo = $_POST['titulo'];
        $posicao = $_POST['posicao'];
        $cor = $_POST['cor'];
        $imagemURL = $_POST['imagemURL'];

        $SQLcurso = mysqli_query($conexao, 'SELECT posicao FROM curso WHERE id = ' . $_POST['idCurso']);
        if(mysqli_num_rows($SQLcurso) == 1) {
            $curso = mysqli_fetch_assoc($SQLcurso);

            if($posicao < $curso['posicao']) {
                $posicaoMenosUm = $posicao - 1;

                mysqli_query($conexao, 'UPDATE curso SET posicao = posicao + 1 WHERE posicao > ' . $posicaoMenosUm . ' AND posicao < ' . $curso['posicao']);
            } else {
                if($posicao > $curso['posicao']) {
                    $posicaoMaisUm = $posicao + 1;
    
                    mysqli_query($conexao, 'UPDATE curso SET posicao = posicao - 1 WHERE posicao > ' . $curso['posicao'] . ' AND posicao < ' . $posicaoMaisUm);
                }
            }

            if(mysqli_query($conexao, "UPDATE curso SET titulo = '$titulo', posicao = $posicao, cor = '$cor', imagemURL = '$imagemURL' WHERE id = $idCurso")) {
                echo 'sucesso';
            }
        }
    }

    // Excluir curso
    if($_POST['tarefa'] == 'excluirCurso') {
        $idCurso = $_POST['idCurso'];
        $posicao = $_POST['posicao'];

        if(mysqli_query($conexao, 'DELETE FROM curso WHERE id = ' . $idCurso)) {
            if(mysqli_query($conexao, 'UPDATE curso SET posicao = posicao - 1 WHERE posicao > ' . $posicao)) {
                echo 'sucesso';
            }
        }
    }
}
?>