<?php
if(isset($_GET['mensagem'])) {
    header('Content-Type: application/json');

    session_start();
    
    if(!isset($_SESSION['idSessao'])) {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, 'https://gateway.watsonplatform.net/assistant/api/v2/assistants/9d3a2d60-e119-46d6-b2a4-114d652b3651/sessions?version=2019-02-28');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . 'sNFoE-V9uSlzsKKjrDNCdvsTE2JlFYJfQQ2nAuZg5Jvy');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
        $retorno = curl_exec($ch);
    
        $retorno = json_decode($retorno);
    
        $_SESSION['idSessao'] = $retorno->session_id;
        
        curl_close($ch);

        $saudar = '"saudar": true,';
    } else {
        $saudar = '';
    }

    date_default_timezone_set('America/Sao_Paulo');

    if(date('H:i:s') >= '03:30:00' && date('H:i:s') < '12:00:00') {
        $periodo = 'Bom dia';
    } else if(date('H:i:s') >= '12:00:00' && date('H:i:s') < '18:00:00') {
        $periodo = 'Boa tarde';
    } else {
        $periodo = 'Boa noite';
    }

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://gateway.watsonplatform.net/assistant/api/v2/assistants/9d3a2d60-e119-46d6-b2a4-114d652b3651/sessions/' . $_SESSION['idSessao'] . '/message?version=2019-02-28');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{
        "input": {
            "text": "' . $_GET['mensagem'] . '",
            "options": {
                "return_context": true
            }
        },
        "context": {
            "skills": {
                "main skill": {
                    "user_defined": {
                        ' . $saudar . '
                        "periodo": "' . $periodo . '"
                    }
                }
            }
        }
    }');
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . 'sNFoE-V9uSlzsKKjrDNCdvsTE2JlFYJfQQ2nAuZg5Jvy');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $retorno = json_encode(curl_exec($ch));

    curl_close($ch);

    echo json_decode($retorno);
}
?>