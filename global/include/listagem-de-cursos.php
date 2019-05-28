<?php
header('Content-Type: application/json');

include '../../global/include/banco-de-dados.php';

$SQL = mysqli_query($conexao, 'SELECT * FROM curso ORDER BY posicao ASC');
if(mysqli_num_rows($SQL) >= 1) {
    $i = 0;
    while($curso = mysqli_fetch_assoc($SQL)) {
        $JSON[$i]['titulo'] = $curso['titulo'];
        $JSON[$i]['posicao'] = $curso['posicao'];
        $JSON[$i]['cor'] = $curso['cor'];
        $JSON[$i]['imagemURL'] = $curso['imagemURL'];
        $i++;
    }
}
echo json_encode($JSON);
?>