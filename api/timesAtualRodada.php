<?php
require_once 'api/api.php';
function timesAtualRodada()
{
    global $MercadoPorRodada; // Variável global
    //global $MaisEscalados; // Variável global
    $i = 0;
    foreach ($MercadoPorRodada['clubes'] as $clubes) {
        //var_dump($clube_casa_id['partida_id']);
        foreach ($MercadoPorRodada['partidas'] as $partidas) {
            if ($partidas['clube_casa_id'] == $clubes['id']) {

                while ($i < 1) {
                    $date = date_create($partidas['partida_data']);
                    $partidaValida = str_replace(true, 'Partida válida!', $partidas['valida']);
                    $partidaValida = str_replace(false, 'Partida não válida!', $partidas['valida']);


                        //JOGOS DA RODADA EM CARROSSEL
                    echo '<div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center">' . $partidas['placar_oficial_mandante'] . ' X ' . $partidas['placar_oficial_visitante'] . '</h5>
                                <p class="card-text text-center">' . '<img src="' . $clubes['escudos']['45x45'] 
                                . '" class="img-fluid" alt="Responsive image" width="75" height="75">' 
                                . ' ' . $partidas['placar_oficial_mandante'] . ' x ' 
                                . $partidas['placar_oficial_visitante'] . ' ' 
                                . '<img src="' . $MercadoPorRodada['clubes'][$partidas['clube_visitante_id']]['escudos']['45x45'] 
                                . '" class="img-fluid" alt="Responsive image" width="75" height="75">' .  '</p>
                                <p class="card-text text-center">' . $partidaValida . '</p>
                                <p class="card-text text-center">'. $partidas['local']. '<br>'. date_format($date, 'd/m/Y H:i') . '</p>
                            </div>
                        </div>';
                    $i++;
                    

                }
                
            }
        }
    }
} //Fim da função Times Rodada Hoje
