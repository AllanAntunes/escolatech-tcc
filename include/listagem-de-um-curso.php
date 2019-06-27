<?php
if(isset($_GET['curso'])) {
    include 'banco-de-dados.php';

    $SQLcurso = mysqli_query($conexao, 'SELECT id, titulo FROM curso');
    if(mysqli_num_rows($SQLcurso) >= 1) {
        $JSON['existe'] = FALSE;
        $JSON['titulo'] = '';
        $JSON['capitulos'] = array();
        
        $localizar = array(' ', '/', 'ã', 'á', 'à', 'â', 'é', 'è', 'ê', 'í', 'ì', 'î', 'õ', 'ó', 'ò', 'ô', 'ú', 'ù', 'û', 'ç');
        $substituirPor = array('-', '-', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'c');

        $i = 0;
        while($curso = mysqli_fetch_assoc($SQLcurso)) {
            if($_GET['curso'] == str_replace($localizar, $substituirPor, strtolower($curso['titulo']))) {
                $JSON['existe'] = TRUE;
                $JSON['id'] = $curso['id'];
                $JSON['titulo'] = $curso['titulo'];
                $JSON['slug'] = str_replace($localizar, $substituirPor, strtolower($curso['titulo']));

                $idCurso = $curso['id'];
            }
            
            $i++;
        }

        $SQLcapitulo = mysqli_query($conexao, 'SELECT id, titulo, posicao FROM capitulo WHERE idCurso = ' . $idCurso . ' ORDER BY posicao ASC');
        if(mysqli_num_rows($SQLcapitulo) >= 1) {
            $inIdCapitulo = '';

            $j = 0;
            while($capitulo = mysqli_fetch_assoc($SQLcapitulo)) {
                $JSON['capitulos'][$j]['id'] = $capitulo['id'];
                $JSON['capitulos'][$j]['titulo'] = $capitulo['titulo'];
                $JSON['capitulos'][$j]['slug'] = str_replace($localizar, $substituirPor, strtolower($capitulo['titulo']));
                $JSON['capitulos'][$j]['posicao'] = $capitulo['posicao'];

                $SQLconteudo = mysqli_query($conexao, 'SELECT * FROM conteudo WHERE idCapitulo = ' . $capitulo['id'] . ' ORDER BY posicao ASC');
                if(mysqli_num_rows($SQLconteudo) >= 1) {
                    $JSON['capitulos'][$j]['temConteudo'] = 1;

                    $k = 0;
                    while($conteudo = mysqli_fetch_assoc($SQLconteudo)) {
                        if($conteudo['tipo'] == 1) {
                            $SQLtopico = mysqli_query($conexao, 'SELECT titulo FROM topico WHERE idConteudo = ' . $conteudo['id']);
                            if(mysqli_num_rows($SQLtopico) == 1) {
                                $topico = mysqli_fetch_assoc($SQLtopico);
    
                                $JSON['capitulos'][$j]['conteudos'][$k]['id'] = $conteudo['id'];
                                $JSON['capitulos'][$j]['conteudos'][$k]['tipo'] = $conteudo['tipo'];
                                $JSON['capitulos'][$j]['conteudos'][$k]['titulo'] = $topico['titulo'];
                                $JSON['capitulos'][$j]['conteudos'][$k]['slug'] = str_replace($localizar, $substituirPor, strtolower($topico['titulo']));
                                $JSON['capitulos'][$j]['conteudos'][$k]['posicao'] = $conteudo['posicao'];
    
                                $k++;
                            }
                        } else if($conteudo['tipo'] == 2) {
                            $SQLlistaExercicios = mysqli_query($conexao, 'SELECT id FROM listaExercicios WHERE idConteudo = ' . $conteudo['id']);
                            if(mysqli_num_rows($SQLlistaExercicios) == 1) {
                                $listaExercicios = mysqli_fetch_assoc($SQLlistaExercicios);

                                $JSON['capitulos'][$j]['conteudos'][$k]['id'] = $conteudo['id'];
                                $JSON['capitulos'][$j]['conteudos'][$k]['tipo'] = $conteudo['tipo'];
                                $JSON['capitulos'][$j]['conteudos'][$k]['posicao'] = $conteudo['posicao'];

                                $k++;
                            }
                        } else {
                            echo 'Ocorreu um erro.';
                        }
                    }
                } else {
                    $JSON['capitulos'][$j]['temConteudo'] = 0;
                }
                $j++;
            }
        }
    }
}
echo json_encode($JSON);
?>