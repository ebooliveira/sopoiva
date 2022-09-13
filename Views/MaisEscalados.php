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

                    echo '<div class="accordion" id="accordionExample' . $subArray['Atleta']['atleta_id'] . '">
                    <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne' . $subArray['Atleta']['atleta_id'] . '">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne' . $subArray['Atleta']['atleta_id'] . '" aria-expanded="true" aria-controls="collapseOne' . $subArray['Atleta']['atleta_id'] . '">
                        <div class="row">
                            <div class="col-1">
                                <span class="badge bg-dark">' . $i . '</span> <br>
                                <img src="' . $subArray['escudo_clube'] . '" width="25" height="25" alt="...">
                            </div>
                            <div class="col-2">
                                <img src="' . $foto . '"" class="rounded-circle" width="50" height="50" alt="...">
                            </div>
                            <div class="col-6">
                                <h5 class="card-title text-left">' . $subArray['Atleta']['apelido_abreviado'] . '</h5>
                                <p class="card-text text-left">' . $subArray['clube_nome'] . '</p>
                            </div>
                            <div class="col-3">
                                <span class="badge bg-dark rounded-pill">Escalações: </span> <br>
                                <span class="badge bg-dark rounded-pill">' . $subArray['escalacoes'] . '</span>
                            </div>
                        </div>
                    </button>
                    </h2>
                    <div id="collapseOne' . $subArray['Atleta']['atleta_id'] . '" class="accordion-collapse collapse" aria-labelledby="headingOne' . $subArray['Atleta']['atleta_id'] . '" data-bs-parent="#accordionExample' . $subArray['Atleta']['atleta_id'] . '">
                    <div class="accordion-body">
                    <div class="row">                    
                        <div class="col-12">
                            <p class="card-text"><b>' . $todas['apelido'] . '</b> - ' . '<span class="badge bg-warning text-dark"> C$ ' . $todas['preco_num'] . '</span></p>
                            <p class="card-text"><b>' . $subArray['clube_nome'] . ' - ' . $subArray['posicao'] . '</b></p>
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
