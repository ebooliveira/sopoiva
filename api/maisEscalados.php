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
                    echo '<ol class="list-group list-group-numbered-">';
                    echo '<li class="list-group-item d-flex justify-content-between align-items-start">';
                    echo '<div class="ms-2 me-auto">';
                    echo '<div class="fw-bold">' . $i . ' - ' . '<img src="' 
                    . $foto . '"class="img-fluid" alt="Responsive image" width="50" height="50" align="left">' 
                    . $subArray['Atleta']['apelido'] . '</div>'  
                    . $subArray['posicao'] . '-' . '<img src="' 
                    . $subArray['escudo_clube'] . '"class="img-fluid" alt="Responsive image" width="15" height="15" align="">' . '</div>';
                    echo '<span class="badge bg-dark rounded-pill">'
                    . $subArray['escalacoes'] . ' Escalações' . '</span>';
                    echo '</li>';
                    echo '</ol>';
                    break;
                }
            }
        }
    }
}