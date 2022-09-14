<?php
header("content-type: text/html; charset=utf-8");


$url = "https://api.cartola.globo.com/mercado/status";
$urlTodasInformacoes = 'https://api.cartola.globo.com/atletas/mercado';
$urlMercadoPorRodada = 'https://api.cartola.globo.com/partidas/';
$urlMaisEscalados = "https://api.cartola.globo.com/mercado/destaques";
$urlMelhorTimePosRodada = "https://api.cartola.globo.com/pos-rodada/destaques";
$urlMaisEscaladosReservas = 'https://api.cartola.globo.com/mercado/destaques/reservas';

$urlPontuandoNaRodada = 'https://api.cartola.globo.com/atletas/pontuados';

//url mercadostatus
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
$statusMercado = json_decode($response, true); // Decodifica o JSON
global $statusMercado;


//$urlMaisEscalados
$options2 = array(
    'http' =>
    array(
        'method' => 'GET',
        'user_agent' => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        'timeout' => 1
    )
);
$context2 = stream_context_create($options2); // Cria o contexto da requisição
$response2 = file_get_contents($urlMaisEscalados, false, $context2); // Faz a requisição
$MaisEscalados = json_decode($response2, true); // Decodifica o JSON

// $urlMaisEscaladosReservas
$options6 = array(
    'http' =>
    array(
        'method' => 'GET',
        'user_agent' => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        'timeout' => 1
    )
);
$context6 = stream_context_create($options6); // Cria o contexto da requisição
$response6 = file_get_contents($urlMaisEscaladosReservas, false, $context6); // Faz a requisição
$MaisEscaladosReservas = json_decode($response6, true); // Decodifica o JSON


// $urlTodasInformacoes
$options3 = array(
    'http' =>
    array(
        'method' => 'GET',
        'user_agent' => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        'timeout' => 1
    )
);
$context3 = stream_context_create($options3); // Cria o contexto da requisição
$response3 = file_get_contents($urlTodasInformacoes, false, $context3); // Faz a requisição
$TodasInformacoes = json_decode($response3, true); // Decodifica o JSON


// $urlMercadoPorRodada
$options4 = array(
    'http' =>
    array(
        'method' => 'GET',
        'user_agent' => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        'timeout' => 1
    )
);
$context4 = stream_context_create($options4); // Cria o contexto da requisição
$response4 = file_get_contents($urlMercadoPorRodada, false, $context4); // Faz a requisição
$MercadoPorRodada = json_decode($response4, true); // Decodifica o JSON

// $urlMelhorTimePosRodada
$options5 = array(
    'http' =>
    array(
        'method' => 'GET',
        'user_agent' => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        'timeout' => 1
    )
);
$context5 = stream_context_create($options5); // Cria o contexto da requisição
$response5 = file_get_contents($urlMelhorTimePosRodada, false, $context5); // Faz a requisição
$MelhorTimePosRodada = json_decode($response5, true); // Decodifica o JSON


// $urlMaisEscaladosReservas
$options6 = array(
    'http' =>
    array(
        'method' => 'GET',
        'user_agent' => 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)',
        'timeout' => 1
    )
);
$context6 = stream_context_create($options6); // Cria o contexto da requisição
$response6 = file_get_contents($urlMaisEscaladosReservas, false, $context6); // Faz a requisição
$MaisEscaladosReservas = json_decode($response6, true); // Decodifica o JSON




function MercadoStatus()
{
    global $statusMercado; // Variável global
    if ($statusMercado['status_mercado'] == 2) { // Se o status do mercado for 2 (aberto)
        //Mensagem de status do mercado aberto com BG verde
        echo '<div class="alert alert-danger" role="alert">Status: <b>Fechado</b></div>';
    } else if ($statusMercado['status_mercado'] == 4) { // Se o status do mercado for 1 (Fechado)
        echo '<div class="alert alert-warning" role="alert">Status: <b>Em Manutenção!</b></div>'; // Exibe a mensagem de mercado aberto
    } else {
        echo '<div class="alert alert-success" role="alert">Status: <b>Aberto</b></div>'; // Exibe a mensagem de mercado indefinido
    }

    //var_dump($statusMercado); // Exibe o JSON
    //echo "<p>Status do mercado: " . $statusMercado['status_mercado'] . "</p>"; // Exibe o status do mercado
} //Fim da função

function RodadaAtual()
{
    global $statusMercado; // Variável global
    //Mensagem da rodada atual com BG verde
    echo '<div class="alert alert-success" role="alert">Rodada: <b>' . $statusMercado['rodada_atual'] . '</b></div>';
} //Fim da função

function TimesRodadaHoje()
{
    global $MercadoPorRodada; // Variável global
    //global $MaisEscalados; // Variável global
    $i = 0;
    foreach ($MercadoPorRodada['clubes'] as $clubes) {
        //var_dump($clube_casa_id['partida_id']);
        foreach ($MercadoPorRodada['partidas'] as $partidas) {
            if ($partidas['clube_casa_id'] == $clubes['id']) {
                $date = date_create($partidas['partida_data']);
                //$date1 = date_create($partidas['inicio_cronometro_tr']);
                $partidaValida = str_replace(true, 'Partida válida!', $partidas['valida']);



                $aovivo = str_replace('PAUSADO', '', $partidas['status_cronometro_tr']);
                $i++;
                echo '<ol class="list-group list-group-numbered">';
                echo '<span class="badge badge-danger">' .  '</span>';
                echo '<li class="list-group-item justify-content-between align-items-start">';
                echo '<span class="badge badge-danger badge">' . $aovivo . '</span>';
                echo '<span class="badge badge-success dg-left">' . $partidas['periodo_tr'] . '</span>';
                //echo '<span class="badge badge-info dg-left">' . date_format($date1, 'h:i:s') . '</span>';

                echo '<div class="text-center">';
                //echo '<span class="badge badge-danger">' . $partidaValida . '</span>';
                echo '<div class="fw-bold">' . '<img src="' . $clubes['escudos']['45x45'] . '" class="img-fluid" alt="Responsive image" width="45" height="45">' . ' ' . $partidas['placar_oficial_mandante'] . ' x ' . $partidas['placar_oficial_visitante'] . ' ' . '<img src="' . $MercadoPorRodada['clubes'][$partidas['clube_visitante_id']]['escudos']['45x45'] . '" class="img-fluid" alt="Responsive image" width="45" height="45">' . '</b></div>'; // Exibe o nome do atleta
                echo '<span class="badge badge-warning">' . $partidaValida . '</span>'; // Exibe a posição do atleta
                echo '<div class="footer">';
                echo '<div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</li>';
                echo '<span class="badge badge-dark">' .  $partidas['local'] . ' - ' . date_format($date, 'd/M H:i') . '</span>';
                echo '</ol>';
                break;
            }
        }
    }
} //Fim da função Times Rodada Hoje

function MelhorTimePosRodada()
{
    global $MelhorTimePosRodada;
    foreach ($MelhorTimePosRodada as $mito) {
        echo '<div class="card" style="width: 18rem;">';
        echo '<img src="' . $mito['url_escudo_svg'] . '" class="card-img-left" alt="..."  width="50" height="50">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $mito['nome_cartola'] . '</h5>';
        echo '<p class="card-text">' . $mito['rodada_time_id'] . '</p>';
        echo '</div>';
        echo '</div>';
        break;
    }
}