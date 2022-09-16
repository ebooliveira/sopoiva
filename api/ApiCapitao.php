<?php
$url = "https://api.cartola.globo.com/mercado/selecao";
$options = array(
    'http' =>
    array(
        'method' => 'GET',
        'user_agent' => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)', // Tipo de navegador que está fazendo a requisição
        'timeout' => 1
    )
); // Fim das opções da requisição
$context = stream_context_create($options); // Cria o contexto da requisição
$response = file_get_contents($url, false, $context); // Faz a requisição
$capitaes = json_decode($response, true); // Decodifica o JSON

