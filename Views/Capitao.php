<?php
$url = "https://api.cartola.globo.com/mercado/selecao";
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
$capitaes = json_decode($response, true); // Decodifica o JSON

function Capitao()
{
    global $capitaes;

    foreach ($capitaes['capitaes'] as $key => $capitaes) {

        $posicao = $capitaes['posicao'];
        $posicao_abreviada = $capitaes['posicao_abreviacao'];
        $clube = $capitaes['clube'];
        $escudo_clube = $capitaes['escudo_clube'];
        $clube_id = $capitaes['clube_id'];
        $escalacoes = $capitaes['escalacoes'];
        $escalacoes_formatado = number_format($escalacoes, 0, '.', '.');
        $Atleta = $capitaes['Atleta']; // Array de atletas
        $nome = $Atleta['nome'];
        $apelido = $Atleta['apelido'];
        $apelido_abreviado = $Atleta['apelido_abreviado'];
        $foto = $Atleta['foto'];
        $fotoFormatada = str_replace('FORMATO', '140x140', $foto);
        $atleta_id = $Atleta['atleta_id'];
        $preco_editorial = $Atleta['preco_editorial'];
        $preco_editorial_formatado = number_format($preco_editorial, 2, ',', '.');

        if ($posicao_abreviada == 'ata') {
            $coresPosicao_abreviacao = 'danger';
        } else if ($posicao_abreviada == 'gol' || $posicao_abreviada == 'lat' || $posicao_abreviada == 'zag') {
            $coresPosicao_abreviacao = 'warning';
        } else if ($posicao_abreviada == 'mei') {
            $coresPosicao_abreviacao = 'primary';
        } else if ($posicao_abreviada == 'tec') {
            $coresPosicao_abreviacao = 'success';
        } else {
            $coresPosicao_abreviacao = 'secondary';
        }

        echo '<div class="accordion" id="accordionExample' . $atleta_id . '">
    <div class="accordion-item"> 
    <h2 class="accordion-header" id="headingOne' . $atleta_id . '">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $atleta_id . '" aria-expanded="false" aria-controls="collapse' . $atleta_id . '">
            <div class="row">
                            <div class="col-1">
                                <div>
                                    <span class="badge bg-dark">P</span>
                                </div>
                            </div>
                                <div class="col-2">
                                    <img src="' . $fotoFormatada . '"" class="rounded-circle" width="50" height="50" alt="...">
                                </div>
                            <div class="col-6">
                                <h5 class="card-title">' . $apelido_abreviado . '</h5>
                                <span class="badge bg-' . $coresPosicao_abreviacao . '">' . $posicao . ' - ' . $clube . '</span>
                            </div>
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-6">
                                    <p class="badge rounded-pill bg-dark">' . $escalacoes_formatado  . '</p>
                                    </div>
                                    <div class="col-6">
                                    </div>
                                </div>                                
                            </div>
                        </div>
            </button>
        </h2>
        <div id="collapse' . $atleta_id . '" class="accordion-collapse collapse" aria-labelledby="headingOne' . $atleta_id . '" data-bs-parent="#accordionExample' . $atleta_id . '">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <h5 class="card-title">' . $nome . '</h5>
                                <span class="badge bg-' . $coresPosicao_abreviacao . '">' . $posicao . ' - ' . $clube . '</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <p class="card-text">Preço: C$ ' . $preco_editorial_formatado . '</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <img src="' . $fotoFormatada . '"" class="rounded-circle" width="150" height="150" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>';
    }
}
