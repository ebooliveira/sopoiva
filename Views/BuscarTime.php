<?php
isset($_GET["api"]) ? $api = $_GET["api"] : $api = null;
isset($_GET["team"]) ? $team = $_GET["team"] : $team = null;
if ($api === "busca-time") {
    $url = "https://api.cartola.globo.com/times?q=". rawurlencode($team);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response;
} else {
    echo "Erro";
}

