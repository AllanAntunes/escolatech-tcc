<?php
header('Content-Type: application/json');

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://gateway.watsonplatform.net/assistant/api/v2/assistants/9d3a2d60-e119-46d6-b2a4-114d652b3651/sessions?version=2019-02-28');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . 'sNFoE-V9uSlzsKKjrDNCdvsTE2JlFYJfQQ2nAuZg5Jvy');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

$retorno = curl_exec($ch);

curl_close($ch);

$retorno = json_decode($retorno);

echo $retorno->session_id;
?>