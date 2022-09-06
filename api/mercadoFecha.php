<?php
require_once 'api.php';
function MercadoFecha()
{
    global $statusMercado; // Variável global
    $fechaMercado = array(
        'fechamento' => $statusMercado['fechamento']
    );
    $stringMercado = json_encode($fechaMercado); // Converte o array para JSON
    $objetoMercado = json_decode($stringMercado, true); // Decodifica o JSON

    $fechamento = array(
        'fechamento' => $objetoMercado['fechamento']['dia'], // Retorna o dia do fechamento do mercado
        'mes' => $objetoMercado['fechamento']['mes'], // Retorna o mês do fechamento do mercado
        'hora' => $objetoMercado['fechamento']['hora'], // Retorna a hora do fechamento do mercado
        'minuto' => $objetoMercado['fechamento']['minuto'], // Retorna o minuto do fechamento do mercado
        'segundo' => $objetoMercado['fechamento']['timestamp'] // Retorna o segundo do fechamento do mercado
    );

    if ($statusMercado['status_mercado'] == 4) { // Se o status do mercado for 4 (fechado)
        echo '<span class="badge badge-secondary">Mercado: <b>' . 'Manunteção' . '</b></span>'; // Mensagem de status do mercado fechado com BG cinza
    } else if ($statusMercado['status_mercado'] == 2) {
        echo '<span class="badge badge-secondary">Mercado: <b>' . 'Fechado' . '</b></span>'; // Mensagem de status do mercado fechado com BG Vermelho
    } else { // Se o status do mercado for 2 (aberto)
        $data = new DateTime(); // Instancia a classe DateTime
        $data->setTimestamp($fechamento['segundo']); // Seta o timestamp do fechamento do mercado
        $data->setTimezone(new DateTimeZone('America/Sao_Paulo')); // Seta o timezone para São Paulo
        $data->format('d/m/Y H:i:s'); // Formata a data
        $hoje    = new \DateTime(); // Instancia a classe DateTime
        $intervalo = $hoje->diff($data); // Calcula a diferença entre a data de hoje e a data do fechamento do mercado

        //Função onload regressivo
        echo '<script type="text/javascript">';
        echo 'window.onload = function() {';
        echo 'var countDownDate = new Date("' . $data->format('d/m/Y H:i:s') . '").getTime();';
        echo 'var x = setInterval(function() {';
        echo 'var now = new Date().getTime();';
        echo 'var distance = countDownDate - now;'; // Calcula a diferença entre a data de hoje e a data do fechamento do mercado
        echo 'var days = Math.floor(distance / (1000 * 60 * 60 * 24));';
        echo 'var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));';
        echo 'var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));';
        echo 'var seconds = Math.floor((distance % (1000 * 60)) / 1000);';
        echo 'document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";';
        echo 'if (distance < 0) {';
        echo 'clearInterval(x);';
        echo 'document.getElementById("demo").innerHTML = "EXPIRED";';
        echo '}';
        echo '}, 1000);';
        echo '}';
        echo '</script>';
        echo '<span class="badge badge-success">Mercado: <b>' . 'Aberto' . '</b></span>'; // Mensagem de status do mercado aberto com BG verde
        echo '<span class="badge badge-success">Faltam: <b>' . $intervalo->format('%a dias %h horas %i minutos %s segundos') . '</b></span>';
        echo '<span class="badge badge-success">Fechamento: <b>' . $data->format('d/m/Y H:i:s') . '</b></span>';
        echo '<span class="badge badge-success">Fechamento: <b id="demo"></b></span>';
    }
}
