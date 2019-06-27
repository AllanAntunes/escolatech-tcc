<?php
include 'banco-de-dados.php';

// https://escolatech.net/admin/editar/novo/14/
// Diretório: admin; slug: editar; idCapitulo: 14;

// https://escolatech.net/admin/editar/2042/
// Diretório: admin; slug: editar; idConteudo: 2042;

// Tipo 1 = Tópico
// Tipo 2 = Lista de exercícios

if(isset($_GET['idConteudo'])) {
    $SQLconteudo = mysqli_query($conexao, 'SELECT * FROM conteudo WHERE id = ' . $_GET['idConteudo']);
    if(mysqli_num_rows($SQLconteudo) == 1) {
        $conteudo = mysqli_fetch_assoc($SQLconteudo);
    
        if($conteudo['tipo'] == 1) {
            $JSON['idCapitulo'] = $conteudo['idCapitulo'];
            $JSON['tipo']  = $conteudo['tipo'];
            $JSON['posicao'] = $conteudo['posicao'];
    
            $SQLtopico = mysqli_query($conexao, 'SELECT * FROM topico WHERE idConteudo = ' . $_GET['idConteudo']);
            if(mysqli_num_rows($SQLtopico) == 1) {
                $topico = mysqli_fetch_assoc($SQLtopico);
    
                $JSON['titulo'] = $topico['titulo'];
                $JSON['anexoURL'] = $topico['anexoURL'];
                $JSON['conteudo'] = $topico['conteudo'];
                $JSON['idVideo'] = $topico['idVideo'];
            }
        } else if($conteudo['tipo'] == 2) {
            $JSON['idCapitulo'] = $conteudo['idCapitulo'];
            $JSON['tipo'] = $conteudo['tipo'];
            $JSON['posicao'] = $conteudo['posicao'];
    
            $SQLlistaDeExercicios = mysqli_query($conexao, 'SELECT id FROM listaDeExercicios WHERE idConteudo = ' . $_GET['idConteudo']);
            if(mysqli_num_rows($SQLlistaDeExercicios) == 1) {
                $listaDeExercicios = mysqli_fetch_assoc($SQLlistaDeExercicios);
    
                $SQLexercicio = mysqli_query($conexao, 'SELECT * FROM exercicio WHERE idListaDeExercicios = ' . $listaDeExercicios['id']);
                if(mysqli_num_rows($SQLexercicio) >= 2) {
                    $i = 0;
                    while($exercicio = mysqli_fetch_assoc($SQLexercicio)) {
                        $JSON['exercicios'][$i]['enunciado'] = $exercicio['enunciado'];
                        $JSON['exercicios'][$i]['idVideoResolucao'] = $exercicio['idVideoResolucao'];
                        $JSON['exercicios'][$i]['posicao'] = $exercicio['posicao'];
    
                        $i++;
                    }
                }
            }
        } else {
            echo 'Erro: o valor "tipo" do conteúdo está incorreto ou não existe.';
        }
    }
}

echo json_encode($JSON);
?>