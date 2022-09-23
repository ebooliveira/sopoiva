<?php

$url = "https://api.cartola.globo.com/partidas/";
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
$confronto = json_decode($response, true); // Decodifica o JSON
//var_dump($confronto);

function Times()
{
    global $confronto;
    $i = 0;
    foreach ($confronto['clubes'] as $key => $clube) {
        foreach ($confronto['partidas'] as $key => $partida) {
            $id_1 = $clube['id'];
            $id_2 = $partida['clube_casa_id'];
            $id_3 = $partida['clube_visitante_id'];
            $nome_clube_visitante = $confronto['clubes'][$partida['clube_visitante_id']]['abreviacao'];
            $escudo_clube_visitante = $confronto['clubes'][$partida['clube_visitante_id']]['escudos']['60x60'];
            if ($id_1 == $id_2) {
                while ($i < 10) {
                    isset($clube['id']) ? $id_clube = $clube['id'] : $id_clube = null; // ID do clube
                    isset($clube['nome']) ? $nome_clube = $clube['nome'] : $nome_clube = null; // Nome do clube
                    isset($clube['abreviacao']) ? $nome_clube_abreviado = $clube['abreviacao'] : $nome_clube_abreviado = null; // Nome abreviado do clube
                    isset($clube['escudos']['60x60']) ? $escudo_clube = $clube['escudos']['60x60'] : $escudo_clube = null; // URL do escudo do clube
                    isset($clube['nome_fantasia']) ? $nome_clube_fantasia = $clube['nome_fantasia'] : $nome_clube_fantasia = null; // Nome fantasia do clube

                    isset($partida['partida_id']) ? $id_partida = $partida['partida_id'] : $id_partida = null; // ID da partida
                    isset($partida['clube_casa_id']) ? $id_clube_casa = $partida['clube_casa_id'] : $id_clube_casa = null; // ID do clube mandante
                    isset($partida['clube_visitante_id']) ? $id_clube_visitante = $partida['clube_visitante_id'] : $id_clube_visitante = null; // ID do clube visitante
                    isset($partida['clube_casa_posicao']) ? $clube_casa_posicao = $partida['clube_casa_posicao'] : $clube_casa_posicao = null; // Posição do clube mandante
                    isset($partida['clube_visitante_posicao']) ? $clube_visitante_posicao = $partida['clube_visitante_posicao'] : $clube_visitante_posicao = null; // Posição do clube visitante
                    //isset($confronto['partidas']['aproveitamento_mandante']) ? $aproveitamento_mandante = $confronto['partidas']['aproveitamento_mandante'] : $aproveitamento_mandante = null; // Aproveitamento do clube mandante
                    //isset($confronto['partidas']['aproveitamento_visitante']) ? $aproveitamento_visitante = $confronto['partidas']['aproveitamento_visitante'] : $aproveitamento_visitante = null; // Aproveitamento do clube visitante
                    isset($partida['partida_data']) ? $partida_data = date_format(date_create($partida['partida_data']), 'H:i (d/m)') : $partida_data = null; // Data da partida
                    isset($partida['local']) ? $partida_local = $partida['local'] : $partida_local = null; // Local da partida
                    isset($partida['valida']) ? $valida = $partida['valida'] : $valida = null; // Status da partida
                    isset($partida['placar_oficial_mandante']) ? $placar_oficial_mandante = $partida['placar_oficial_mandante'] : $placar_oficial_mandante = null; // Placar oficial do clube mandante
                    isset($partida['placar_oficial_visitante']) ? $placar_oficial_visitante = $partida['placar_oficial_visitante'] : $placar_oficial_visitante = null; // Placar oficial do clube visitante
                    isset($partida['status_transmissao_tr']) ? $status_transmissao_tr = $partida['status_transmissao_tr'] : $status_transmissao_tr = null; // Placar de penaltis do clube mandante
                    isset($partida['inicio_cronometro_tr']) ? $inicio_cronometro_tr = date_format(date_create($partida['inicio_cronometro_tr']), '%Y-%m-%d %H:%i:%s') : $inicio_cronometro_tr = null; // Início do cronômetro da partida
                    isset($partida['periodo_tr']) ? $periodo_tr = $partida['periodo_tr'] : $periodo_tr = null; // Período da partida
                    isset($partida['transmissao']['label']) ? $transmissao_label = $partida['transmissao']['label'] : $transmissao_label = null; // Label da transmissão da partida
                    isset($partida['transmissao']['url']) ? $transmissao_url = $partida['transmissao']['url'] : $transmissao_url = null; // URL da transmissão da partida

                    // Converte o status da transmissão
                    if ($status_transmissao_tr == 'EM_ANDAMENTO') {
                        $status_transmissao = 'AoVivo';
                        $cores_tr = 'danger';
                    } else if ($status_transmissao_tr == 'ENCERRADA') {
                        $status_transmissao = 'Finalizado';
                        $cores_tr = 'success';
                    } else {
                        $status_transmissao = '';
                        $cores_tr = 'secondary';
                    }
                    // Converte o período da partida
                    if ($periodo_tr == 'PRIMEIRO_TEMPO') {
                        $periodo = '1º Tempo';
                        $cores_pr = 'danger';
                    } else if ($periodo_tr == 'SEGUNDO_TEMPO') {
                        $periodo = '2º Tempo';
                        $cores_pr = 'danger';
                    } else if ($periodo_tr == 'POS_JOGO') {
                        $periodo = 'Pós-Jogo';
                        $cores_pr = 'success';
                    } else {
                        $periodo = '';
                        $cores_pr = 'info';
                    }
                    // Converte o status da partida
                    if ($valida == 'true') {
                        $valida = 'Válido!';
                        $cores_v = 'success';
                    } else {
                        $valida = 'Não Válido!';
                        $cores_v = 'danger';
                    }
                    // Converte o dia da semana
                    if (date_format(date_create($partida['partida_data']), 'l') ==  'Sunday') {
                        $dia_semana = 'Segunda-Feira';
                    } else if (date_format(date_create($partida['partida_data']), 'l') == 'Tuesday') {
                        $dia_semana = 'Terça-Feira';
                    } else if (date_format(date_create($partida['partida_data']), 'l') == 'Wednesday') {
                        $dia_semana = 'Quarta-Feira';
                    } else if (date_format(date_create($partida['partida_data']), 'l') == 'Thursday') {
                        $dia_semana = 'Quinta-Feira';
                    } else if (date_format(date_create($partida['partida_data']), 'l') == 'Friday') {
                        $dia_semana = 'Sexta-Feira';
                    } else if (date_format(date_create($partida['partida_data']), 'l') == 'Saturday') {
                        $dia_semana = 'Sábado';
                    } else {
                        $dia_semana = 'Domingo';
                    }

                    //listar partidas
                    echo '
                    <div class="row">
                        <div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">
                                            <p style="text-align:left" class="card-text"><span class="badge bg-primary">' . $clube_casa_posicao . 'º ' . $nome_clube_abreviado . '</span></p>
                                        </div>
                                        <div class="col-4">
                                            <p class="card-text text-center"><img src="' . $escudo_clube . '" width="25" height="25" class="d-inline-block align-rigth" alt=""><span class="badge bg-secondary">' . $placar_oficial_mandante . '</span>  x  <span class="badge bg-secondary">' . $placar_oficial_visitante . '</span><img src="' . $escudo_clube_visitante . '" width="25" height="25" class="d-inline-block align-left" alt=""></p>
                                        </div>
                                        <div class="col-4">
                                            <p style="text-align:right" class="card-text"><span class="badge bg-secondary">' . $nome_clube_visitante . ' ' . $clube_visitante_posicao . 'º</span></p>
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4">
                                            <p style="text-align:left" class="card-text"><span class="badge bg-' . $cores_pr . '">' . $periodo . '</span></p>
                                        </div>
                                        <div class="col-4">
                                            <p class="card-text text-center"><span class="badge bg-'.$cores_v.'">' . $valida . '</span></p>
                                        </div>
                                        <div class="col-4">
                                            <p style="text-align:right" class="card-text"><span class="badge bg-' . $cores_tr . '">' . $status_transmissao . '</span></p>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-4">
                                            <p style="text-align:left" class="card-text"><span class="badge bg-light text-dark">' . $partida_local . '</span></p>
                                        </div>
                                        <div class="col-4">
                                            <p class="card-text text-center"><span class="badge bg-light text-dark">' . $partida_data . '</span></p>
                                        </div>
                                        <div class="col-4">
                                            <p style="text-align:right" class="card-text"><span class="badge bg-light text-dark">' . $dia_semana . '</span></p>
                                        </div>
                                    </div>                                     
                                </div>
                            </div>
                        </div>
                    </div><br>';

                    $i++;
                    break;
                }
            }
        }
    }
}
