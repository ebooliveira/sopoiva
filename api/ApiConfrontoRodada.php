<?php
header("content-type: text/html; charset=utf-8");
class ApiRodadas
{
    public function ConfrontosDaRodada()
    {
        require_once 'api.php';
        $RodadaAtual = $statusMercado['rodada_atual'];
        $ConfrontosDaRodada = 'https://api.cartola.globo.com/partidas/' . $RodadaAtual;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $ConfrontosDaRodada);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $ConfrontosDaRodada = json_decode($response, true);
    }
}
