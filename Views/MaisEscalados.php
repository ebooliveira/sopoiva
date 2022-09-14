<?php
require_once 'api/api.php';
function MaisEscalados1()
{
    global $MaisEscalados; // Variável global
    global $TodasInformacoes; // Variável global
    $i = 0;
    //exibir os 5 primeiros jogadores escalados
    foreach ($MaisEscalados as $subArray) {
        $foto = str_replace('FORMATO', '140x140', $subArray['Atleta']['foto']); // Retorna a foto do atleta
        foreach ($TodasInformacoes['atletas'] as $todas) {
            $info = $todas['atleta_id']; // Exibe o slug do atleta

            if ($info == $subArray['Atleta']['atleta_id']) {
                $i++;
                while ($i <= 5) {
                    if ($subArray['posicao_abreviacao'] == 'ATA') {
                        $coresPosicao_abreviacao = 'danger';
                    } else if ($subArray['posicao_abreviacao'] == 'GOL' || $subArray['posicao_abreviacao'] == 'LAT' || $subArray['posicao_abreviacao'] == 'ZAG') {
                        $coresPosicao_abreviacao = 'warning';
                    } else if ($subArray['posicao_abreviacao'] == 'MEI') {
                        $coresPosicao_abreviacao = 'primary';
                    } else if ($subArray['posicao_abreviacao'] == 'TEC') {
                        $coresPosicao_abreviacao = 'success';
                    } else {
                        $coresPosicao_abreviacao = 'secondary';
                    }
                    if ($todas['minimo_para_valorizar'] != null) {
                        $MinValor = 'Valoriza com ' . $todas['minimo_para_valorizar'] . ' pontos';
                    } else {
                        $MinValor = 'Calculando pontuação...';
                    }
                        $mpm = isset($todas['gato_mestre']['media_pontos_mandante']) ? $todas['gato_mestre']['media_pontos_mandante'] : null;
                        $mpv = isset($todas['gato_mestre']['media_pontos_visitante']) ? $todas['gato_mestre']['media_pontos_visitante'] : null;
                        $mmj = isset($todas['gato_mestre']['media_minutos_jogados']) ? $todas['gato_mestre']['media_minutos_jogados'] : null;
                        $mj = isset($todas['gato_mestre']['minutos_jogados']) ? $todas['gato_mestre']['minutos_jogados'] : null;
                    

                    $scout = $todas['scout']; // Exibe o scout do atleta
                    $scout = array(
                        "SG" => array(
                            "acao" => "Jogo sem sofrer gols", // Jogo sem sofrer gols
                            "pontos" => isset($scout['SG']) ? $scout['SG'] * 5.00 : 0, // Exibe a pontuação do atleta
                            "count" => isset($scout['SG']) ? $scout['SG'] : 0 // Exibe a quantidade de vezes que o atleta fez a ação
                        ),
                        "G" => array(
                            "acao" => "Gol", // Gol
                            "pontos" => isset($todas['scout']['G']) ? $todas['scout']['G'] * 8.00 : 0,
                            "count" => isset($todas['scout']['G']) ? $todas['scout']['G'] : 0
                        ),
                        "A" => array(
                            "acao" => "Assistência", // Assistência
                            "pontos" => isset($todas['scout']['A']) ? $todas['scout']['A'] * 5.00 : 0,
                            "count" => isset($todas['scout']['A']) ? $todas['scout']['A'] : 0
                        ),
                        "DP" => array(
                            "acao" => "Defesa de pênalti", // Defesa de pênalti
                            "pontos" => isset($todas['scout']['DP']) ? $todas['scout']['DP'] * 5.00 : 0,
                            "count" => isset($todas['scout']['DP']) ? $todas['scout']['DP'] : 0
                        ),
                        "DD" => array(
                            "acao" => "Defesa difícil", // Defesa difícil
                            "pontos" => isset($todas['scout']['DD']) ? $todas['scout']['DD'] * 3.00 : 0,
                            "count" => isset($todas['scout']['DD']) ? $todas['scout']['DD'] : 0
                        ),
                        "RB" => array(
                            "acao" => "Roubada de bola", // Roubada de bola
                            "pontos" => isset($todas['scout']['RB']) ? $todas['scout']['RB'] * 1.50 : 0,
                            "count" => isset($todas['scout']['RB']) ? $todas['scout']['RB'] : 0
                        ),
                        "FC" => array(
                            "acao" => "Falta cometida", // Falta cometida
                            "pontos" => isset($todas['scout']['FC']) ? $todas['scout']['FC'] * -0.50 : 0,
                            "count" => isset($todas['scout']['FC']) ? $todas['scout']['FC'] : 0
                        ),
                        "FD" => array(
                            "acao" => "Finalização defendida", // Finalização defendida
                            "pontos" => isset($todas['scout']['FD']) ? $todas['scout']['FD'] * 1.20 : 0,
                            "count" => isset($todas['scout']['FD']) ? $todas['scout']['FD'] : 0
                        ),
                        "FF" => array(
                            "acao" => "Finalização para fora", // Finalização para fora
                            "pontos" => isset($todas['scout']['FF']) ? $todas['scout']['FF'] * -0.80 : 0,
                            "count" => isset($todas['scout']['FF']) ? $todas['scout']['FF'] : 0
                        ),
                        "FS" => array(
                            "acao" => "Falta sofrida", // Falta sofrida
                            "pontos" => isset($todas['scout']['FS']) ? $todas['scout']['FS'] * -0.50 : 0,
                            "count" => isset($todas['scout']['FS']) ? $todas['scout']['FS'] : 0
                        ),
                        "FT" => array(
                            "acao" => "Finalização na trave", // Finalização na trave
                            "pontos" => isset($todas['scout']['FT']) ? $todas['scout']['FT'] * 1.50 : 0,
                            "count" => isset($todas['scout']['FT']) ? $todas['scout']['FT'] : 0
                        ),
                        "GC" => array(
                            "acao" => "Gol contra", // Gol contra
                            "pontos" => isset($todas['scout']['GC']) ? $todas['scout']['GC'] * -4.00 : 0,
                            "count" => isset($todas['scout']['GC']) ? $todas['scout']['GC'] : 0
                        ),
                        "GS" => array(
                            "acao" => "Gol sofrido", // Gol sofrido
                            "pontos" => isset($todas['scout']['GS']) ? $todas['scout']['GS'] * -2.00 : 0,
                            "count" => isset($todas['scout']['GS']) ? $todas['scout']['GS'] : 0
                        ),
                        "I" => array(
                            "acao" => "Impedimento", // Impedimento
                            "pontos" => isset($todas['scout']['I']) ? $todas['scout']['I'] * -0.50 : 0,
                            "count" => isset($todas['scout']['I']) ? $todas['scout']['I'] : 0
                        ),
                        "PE" => array(
                            "acao" => "Passe Errado", // Passe Errado
                            "pontos" => isset($todas['scout']['PE']) ? $todas['scout']['PE'] * -0.30 : 0,
                            "count" => isset($todas['scout']['PE']) ? $todas['scout']['PE'] : 0
                        ),
                        "PP" => array(
                            "acao" => "Pênalti perdido", // Pênalti perdido para fora
                            "pontos" => isset($todas['scout']['PP']) ? $todas['scout']['PP'] * -4.00 : 0,
                            "count" => isset($todas['scout']['PP']) ? $todas['scout']['PP'] : 0
                        ),
                        "CV" => array(
                            "acao" => "Cartão Vermelho", // Cartão Vermelho
                            "pontos" => isset($todas['scout']['CV']) ? $todas['scout']['CV'] * -5.00 : 0,
                            "count" => isset($todas['scout']['CV']) ? $todas['scout']['CV'] : 0
                        ),
                        "CA" => array(
                            "acao" => "Cartão Amarelo", // Cartão Amarelo
                            "pontos" => isset($todas['scout']['CA']) ? $todas['scout']['CA'] * -2.00 : 0,
                            "count" => isset($todas['scout']['CA']) ? $todas['scout']['CA'] : 0
                        )
                    );
                    echo '<div class="accordion" id="accordionExample' . $subArray['Atleta']['atleta_id'] . '">
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne' . $subArray['Atleta']['atleta_id'] . '">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne' . $subArray['Atleta']['atleta_id'] . '" aria-expanded="true" aria-controls="collapseOne' . $subArray['Atleta']['atleta_id'] . '">
                        <div class="row">
                            <div class="col-1">
                                <div>
                                    <span class="badge bg-dark">' . $i . '</span>
                                    
                                </div>
                            </div>
                                <div class="col-2">
                                    <img src="' . $foto . '"" class="rounded-circle" width="50" height="50" alt="...">
                                </div>
                            <div class="col-6">
                                <h5 class="card-title">' . $subArray['Atleta']['apelido_abreviado'] . '</h5>
                                <span class="badge bg-' . $coresPosicao_abreviacao . '">' . $subArray['posicao_abreviacao'] . ' - ' . $subArray['clube_nome'] . '</span>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-6">
                                    <p class="badge rounded-pill bg-dark">' . number_format($subArray['escalacoes'], 0, '.', '.')  . '</p>
                                    </div>
                                    <div class="col-6">
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </button>
                    </h2>
                    <div id="collapseOne' . $subArray['Atleta']['atleta_id'] . '" class="accordion-collapse collapse" aria-labelledby="headingOne' . $subArray['Atleta']['atleta_id'] . '" data-bs-parent="#accordionExample' . $subArray['Atleta']['atleta_id'] . '">
                    <div class="accordion-body">
                    <div class="row">                    
                        <div class="col-12">
                            
                            <p class="card-text"><b>' . '<img src="' . $subArray['escudo_clube'] . '" width="25" height="25" alt="..."> - '
                        . $todas['apelido'] . '</b> - ' . '<span class="badge bg-warning text-dark"> C$ '
                        . $todas['preco_num'] . '</span></p>
                            <p class="card-text"><b>' . $subArray['clube_nome'] . ' - ' . $subArray['posicao'] . '</b></p>                            
                            <button class="col-12" type="button" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="visually-hidden"></span>
                                ' . $MinValor . '
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
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                <p><small class="badge bg-light text-dark">
                                    <b>Media de pontos como mandante: '.number_format($mpm , 2, '.', '').' pts</b><br>
                                    <b>Media de pontos como visitante: '.number_format($mpv , 2, '.', '').' pts</b><br>
                                    <b>Media de minutos jogados: '.$mmj.' min</b><br>
                                    <b>Minutos jogados: '.$mj.' min</b><br>
                                </small></p>
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="d-flex justify-content-center">
                            <small>
                                <table class="table table-bordered border-primary">
                                    <thead>
                                        <tr>
                                            <th scope="col">Ação</th>
                                            <th scope="col">Count*</th>
                                            <th scope="col">Pontos</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    //<!-- verificar variaveis e mostrar pontos maior que 0 -->
                    foreach ($scout as $key => $value) {
                        if ($value['pontos'] != 0) {
                            echo '<tr>
                                            <td>' . $value['acao'] . '</td>
                                            <td>' . $value['count'] . '</td>
                                            <td>' . $value['pontos'] . '</td>
                                            </tr>';
                        } else {
                            echo '';
                        }
                    }
                    echo '</tbody>
                                </table>
                          </small></p>
                        </div>
                        <div class="d-grid gap-2">
                                <a href="https://gatomestre.globoesporte.globo.com/atletas/?utm_source=web-cartola&utm_medium=web&utm_term=gatomestre&cartola_p_gm=web&atleta_id=' . $subArray['Atleta']['atleta_id'] . '" class="btn btn-primary" target="_blank">Estatisticas Gato Mestre</a>
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
