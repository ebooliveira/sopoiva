<?php
require_once 'api/api.php';
function timesAtualRodada1()
{
    global $MercadoPorRodada; // Variável global
    global $SelecioneRodada;
    //global $MaisEscalados; // Variável global
    $i = 0;
    foreach ($MercadoPorRodada['clubes'] as $clubes) {

        foreach ($MercadoPorRodada['partidas'] as $partidas) {
            if ($partidas['clube_casa_id'] == $clubes['id']) {

                while ($i < 10) {
                    
                    $date = date_create($partidas['partida_data']);
                    $partidaValida = str_replace(true, 'CartolaFC &copy', $partidas['valida']);
                    $Detalhes = str_replace('veja como foi', 'Veja como foi', $partidas['transmissao']['label']);
                    
                    if ($partidas['status_transmissao_tr'] == 'EM_ANDAMENTO') {
                        $status_transmissao = 'Em Andamento';
                        $cores_tr = 'warning';
                    } else if ($partidas['status_transmissao_tr'] == 'ENCERRADA') {
                        $status_transmissao = 'Finalizado';
                        $cores_tr = 'success';
                    } else {
                        $status_transmissao = 'Não Iniciado';
                        $cores_tr = 'info';
                    }

                    if ($partidas['periodo_tr'] == 'PRIMEIRO_TEMPO') {
                        $periodo_tr = '1º Tempo';
                        $cores_pr = 'warning';
                    } else if ($partidas['periodo_tr'] == 'SEGUNDO_TEMPO') {
                        $periodo_tr = '2º Tempo';
                        $cores_pr = 'warning';
                    } else if ($partidas['periodo_tr'] == 'POS_JOGO') {
                        $periodo_tr = 'Pós-Jogo';
                        $cores_pr = 'success';
                    } else {
                        $periodo_tr = '';
                        $cores_pr = 'danger';
                    }

                    echo '
                    <div class="card text-center">
                        <div class="card-body p-3 mb-2 bg-dark text-white">
                            
                            <div class="row">
                                <div class="col-3">
                                    <img src="' . $clubes['escudos']['60x60'] . '" class="img-fluid" alt="...">
                                    <span class="badge bg-dark text-white">' . $partidas['clube_casa_posicao'] . 'º</span>
                                </div>
                                <div class="col-6">
                                    <h5 class="card-title">' . date_format($date, 'd/m H:i') . '</h5>
                                    <p class="card-text">' . $partidas['local'] . '</p>
                                </div>
                                <div class="col-3">
                                    <img src="' . $MercadoPorRodada['clubes'][$partidas['clube_visitante_id']]['escudos']['60x60'] . '" class="img-fluid" alt="...">
                                    <span class="badge bg-dark text-white">' . $partidas['clube_visitante_posicao'] . 'º</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
<!--                                    <span class="badge bg-light  text-dark">' . $partidaValida . '</span>                                 -->
                                </div>
                                <div class="col-6">
                                    <span class="badge bg-light  text-dark">' . $partidas['placar_oficial_mandante'] . ' X ' . $partidas['placar_oficial_visitante'] . '</span>
                                    </div>
                                <div class="col-3">
                                    <!--<span class="badge bg-light  text-dark">' . $periodo_tr . '</span>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                <span class="badge bg-' . $cores_tr . '">' . $status_transmissao . '</span>
                                </div>
                                <div class="col-6" >
                                    <!--<a href="' . $partidas['transmissao']['url'] . '" class="btn btn-dark">' . $Detalhes . '</a>-->
                                    <span class="badge bg-dark text-white">' . $partidaValida . '</span>
                                </div>
                                <div class="col-3">
                                    <span class="badge bg-' . $cores_pr . '">' . $periodo_tr . '</span>
                                </div>
                            </div>
                        </div>
                    </div>';
                    $i++;
                    break;
                }
            }
        }
    }
} //Fim da função Times Rodada Hoje
