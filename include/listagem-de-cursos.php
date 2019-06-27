<?php
header('Content-Type: application/json');

include '../include/banco-de-dados.php';

$SQL = mysqli_query($conexao, 'SELECT * FROM curso ORDER BY posicao ASC');
if(mysqli_num_rows($SQL) >= 1) {
    $i = 0;
    while($curso = mysqli_fetch_assoc($SQL)) {
        $JSON[$i]['id'] = $curso['id'];
        $JSON[$i]['titulo'] = $curso['titulo'];

        $localizar = array(' ', 'ã', 'á', 'à', 'â', 'é', 'è', 'ê', 'í', 'ì', 'î', 'õ', 'ó', 'ò', 'ô', 'ú', 'ù', 'û', 'ç');
        $substituirPor = array('-', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'c');

        $JSON[$i]['slug'] = str_replace($localizar, $substituirPor, strtolower($curso['titulo']));
        $JSON[$i]['posicao'] = $curso['posicao'];
        $JSON[$i]['cor'] = $curso['cor'];
        $JSON[$i]['imagemURL'] = $curso['imagemURL'];
        $i++;
    }
}
echo json_encode($JSON);
?>