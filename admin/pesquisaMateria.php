<?php
header("Content-Type: text/plain");

$idDisciplina = $_GET['idDisciplina'];

include('configuracoes.php');

$stringMaterias = '<option disabled value selected>Selecione a matéria</option>';

$SQL = mysqli_query($conexao, "SELECT * FROM materia WHERE idDisciplina = $idDisciplina");

while($linha = mysqli_fetch_assoc($SQL)){
    $stringMaterias = $stringMaterias . '
    <option value="' . $linha['id'] . '">' . $linha['nome'] . '</option>';
}

echo $stringMaterias;

?>