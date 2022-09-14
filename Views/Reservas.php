<?php
require_once 'api/api.php';
function Reservas()
{
    global $MaisEscaladosReservas; // Variável global
    global $TodasInformacoes; // Variável global 
    $i = 0;
    //exibir os 5 primeiros jogadores escalados
    foreach ($MaisEscaladosReservas as $ReservasMaisEscaladossubArray) {
        $foto = str_replace('FORMATO', '140x140', $ReservasMaisEscaladossubArray['Atleta']['foto']); // Retorna a foto do atleta
        foreach ($TodasInformacoes['atletas'] as $todas) {
            $info = $todas['atleta_id']; // Exibe o slug do atleta

            if ($info == $ReservasMaisEscaladossubArray['Atleta']['atleta_id']) {
                $i++;
                while ($i <= 5) {                    
                    if($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'ata'){
                        $coresPosicao_abreviacao = 'danger';
                    }else if($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'gol' || $ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'lat' || $ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'zag'){
                        $coresPosicao_abreviacao = 'warning';
                    }else if($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'mei'){
                        $coresPosicao_abreviacao = 'primary';
                    }else if ($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'tec'){
                        $coresPosicao_abreviacao = 'success';
                    }else{
                        $coresPosicao_abreviacao = 'secondary';
                    }
                    if($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'ata'){
                        $pos = 'ATA';
                    }else if($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'gol'){
                        $pos = 'GOL';
                    }else if($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'mei'){
                        $pos = 'MEI';
                    }else if($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'tec') {
                        $pos = 'TEC';
                    }else if($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'zag'){
                        $pos = 'ZAG';
                    }else if($ReservasMaisEscaladossubArray['posicao_abreviacao'] == 'lat'){
                        $pos = 'LAT';
                    }else{
                        $pos = 'NULL';
                    }
                    if($todas['minimo_para_valorizar'] != null){
                        $MinValor = 'Valoriza com '.$todas['minimo_para_valorizar'].' pontos';
                    } else {
                        $MinValor = 'Calculando...';
                    }

                    echo '<div class="accordion" id="accordionExample' . $ReservasMaisEscaladossubArray['Atleta']['atleta_id'] . '">
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne' . $ReservasMaisEscaladossubArray['Atleta']['atleta_id'] . '">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne' . $ReservasMaisEscaladossubArray['Atleta']['atleta_id'] . '" aria-expanded="true" aria-controls="collapseOne' . $ReservasMaisEscaladossubArray['Atleta']['atleta_id'] . '">
                        <div class="row">
                            <div class="col-1">
                                <span class="badge bg-dark">' . $i . '</span>
                            </div>
                            <div class="col-2">
                                <img src="' . $foto . '"" class="rounded-circle" width="50" height="50" alt="...">
                            </div>
                            <div class="col-6">
                                <h5 class="card-title">' . $ReservasMaisEscaladossubArray['Atleta']['apelido_abreviado'] . '</h5>
                                <span class="badge bg-'.$coresPosicao_abreviacao.'">'. $pos .' - '. $ReservasMaisEscaladossubArray['clube_nome']. '</span>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-6">
                                    <p class="badge rounded-pill bg-dark">' .  number_format($ReservasMaisEscaladossubArray['escalacoes'], 0, '.', '.') . '</p>
                                    </div>
                                    <div class="col-6">
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </button>
                    </h2>
                    <div id="collapseOne' . $ReservasMaisEscaladossubArray['Atleta']['atleta_id'] . '" class="accordion-collapse collapse" aria-labelledby="headingOne' . $ReservasMaisEscaladossubArray['Atleta']['atleta_id'] . '" data-bs-parent="#accordionExample' . $ReservasMaisEscaladossubArray['Atleta']['atleta_id'] . '">
                    <div class="accordion-body">
                    <div class="row">                    
                        <div class="col-12">
                        <p class="card-text"><b>'. '<img src="' . $ReservasMaisEscaladossubArray['escudo_clube'] . '" width="25" height="25" alt="..."> - '
                        . $todas['apelido'] . '</b> - ' . '<span class="badge bg-warning text-dark"> C$ ' 
                        . $todas['preco_num'] . '</span></p>
                            <p class="card-text"><b>' . $ReservasMaisEscaladossubArray['clube_nome'] . ' - ' . $ReservasMaisEscaladossubArray['posicao'] . '</b></p>
                            <button class="col-12" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="visually-hidden"></span>
                                '.$MinValor.'
                            </button>
                            <table class="table table-bordered border-primary">
                                <thead>
                                    <tr>
                                        <th scope="col">Pts</th>
                                        <th scope="col">Preço</th>
                                        <th scope="col">Variação</th>
                                        <th scope="col">Jogos</th>
                                        <th scope="col">Média</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>' . $todas['pontos_num'] . '</td>
                                        <td>' . $todas['preco_num'] . '</td>
                                        <td>' . $todas['variacao_num'] . '</td>
                                        <td>' . $todas['jogos_num'] . '</td>
                                        <td>' . $todas['media_num'] . '</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-grid gap-2">
                                <a href="https://gatomestre.globoesporte.globo.com/atletas/?utm_source=web-cartola&utm_medium=web&utm_term=gatomestre&cartola_p_gm=web&atleta_id=' . $ReservasMaisEscaladossubArray['Atleta']['atleta_id'] . '" class="btn btn-primary" target="_blank">Estatisticas Gato Mestre</a>
                            </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>';
                    break;
                }
            }
        }
    }
}
