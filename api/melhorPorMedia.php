<?php
require_once 'api.php';
function melhorPorMedia()
{
    global $TodasInformacoes; // Variável global
    $i=0;
    //exibir os 5 primeiros jogadores escalados
    foreach ($TodasInformacoes['atletas'] as $todas) {
        $foto = str_replace('FORMATO', '140x140', $todas['foto']); // Retorna a foto do atleta
        $i++;
        
        
        while ($i <= 5) {
            echo '<ol class="list-group list-group-numbered-">';
            echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
            echo '<div type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight' . $todas['atleta_id'] . '" aria-controls="offcanvasRight' . $todas['atleta_id'] . '" class="ms-2 me-auto">';
            echo '<div class="fw-bold">' . $i . ' - ' . '<img src="'
                . $foto . '"class="img-fluid" alt="Responsive image" width="50" height="50" align="left">'
                . $todas['apelido'] . '</div>'
                . $todas['posicao_id'] . '-' . '<img src="'
                . $foto . '"class="img-fluid" alt="Responsive image" width="15" height="15" align="">' . '</div>';
            echo '<span class="badge bg-success rounded-pill">'
                . $todas['media_num'] . ' Média' . '</span>';

            // INICIO - EXIBE DETALHES DO ATLETA
            echo '<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight' . $todas['atleta_id'] . '" aria-labelledby="offcanvasRightLabel">';
            echo '<div class="offcanvas-header">';
            echo '<h5 id="offcanvasRightLabel">' . $todas['apelido'] . '</h5>';
            echo '<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>';
            echo '</div>';
            echo '<div class="offcanvas-body">';
            echo '<div class="card" style="width: 18rem;">';
            echo '<img src="' . $foto . '"class="card-img-top" alt="...">';

            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $todas['apelido'] . '</h5>';
            echo '<p class="card-text">' . '<b>Nome: </b>' . $todas['nome'] . '</p>';
            echo '<p class="card-text">' . '<b>Apelido: </b>' . $todas['apelido'] . '</p>';
            echo '<p class="card-text">' . '<b>Clube: </b>' . $todas['clube_id'] . '<img src="'
                . $foto . '"class="img-fluid" alt="Responsive image" width="15"height="15" align="">' . '</p>';
            echo '<p class="card-text">' . '<b>Posição: </b>' . $todas['posicao_id'] . '</p>';

            echo '<div class="d-grid gap-2">';
            echo '<a href="https://gatomestre.globoesporte.globo.com/atletas/?utm_source=web-cartola&utm_medium=web&utm_term=gatomestre&cartola_p_gm=web&atleta_id=' . $todas['atleta_id'] . '" class="btn btn-dark" target="_blank">Estatisticas Gato Mestre</a>';
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
