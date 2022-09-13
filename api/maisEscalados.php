<?php
require_once 'api.php';
function MaisEscalados()
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
                    echo '<ol class="list-group list-group-numbered- ">';
                    echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                    echo '<div type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight' . $subArray['Atleta']['atleta_id'] . '" aria-controls="offcanvasRight' . $subArray['Atleta']['atleta_id'] . '" class="ms-2 me-auto">';
                    echo '<div class="fw-bold">' . $i . ' - ' . '<img src="'
                        . $foto . '"class="img-fluid" alt="Responsive image" width="50" height="50" align="left">'
                        . $subArray['Atleta']['apelido_abreviado'] . '</div>'
                        . $subArray['posicao_abreviacao'] . '-' . '<img src="'
                        . $subArray['escudo_clube'] . '"class="img-fluid" alt="Responsive image" width="15" height="15" align="">' . '</div>';
                    echo '<span class="badge bg-success rounded-pill">'
                        . $subArray['escalacoes'] . ' Escalações' . '</span>';
                        
                    // INICIO - EXIBE DETALHES DO ATLETA
                    echo '<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight' . $subArray['Atleta']['atleta_id'] . '" aria-labelledby="offcanvasRightLabel">';
                    echo '<div class="offcanvas-header">';
                    echo '<h5 id="offcanvasRightLabel">' . $subArray['Atleta']['apelido_abreviado'] . '</h5>';
                    echo '<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="offcanvas-body">';
                    echo '<div class="card" style="width: 18rem;">';
                    echo '<img src="' . $foto . '"class="card-img-top" alt="...">';

                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $subArray['Atleta']['apelido'] . '</h5>';
                    echo '<p class="card-text">' . '<b>Nome: </b>' . $subArray['Atleta']['nome'] . '</p>';
                    echo '<p class="card-text">' . '<b>Apelido: </b>' . $subArray['Atleta']['apelido'] . '</p>';
                    echo '<p class="card-text">' . '<b>Clube: </b>' . $subArray['clube_nome'] . '<img src="'
                    . $subArray['escudo_clube'] . '"class="img-fluid" alt="Responsive image" width="15"height="15" align="">' . '</p>';
                    echo '<p class="card-text">' . '<b>Posição: </b>' . $subArray['posicao'] . '</p>';

                    echo '<div class="d-grid gap-2">';
                    echo '<a href="https://gatomestre.globoesporte.globo.com/atletas/?utm_source=web-cartola&utm_medium=web&utm_term=gatomestre&cartola_p_gm=web&atleta_id=' . $subArray['Atleta']['atleta_id'] . '" class="btn btn-dark" target="_blank">Estatisticas Gato Mestre</a>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    // FIM  - EXIBE DETALHES DO ATLETA

                    echo '</li>';
                    echo '</ol>';
                    break;
                }
            }
        }
    }
}
