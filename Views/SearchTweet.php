<?php
//Chamar Classe ApiTwitter
use LDAP\Result;

require __DIR__ . '/../api/ApiTwitter.php';
//Instanciar Classe ApiTwitter
$apiTwitter = new ApiTwitter();
//Chamar Método PesquisarTweets
$result = $apiTwitter->PesquisarTweets();
//Converter Json em Array
$result = json_decode($result, true);
function Twitter($result)
{
    //Listar Resultados
    $i = 0;
    foreach ($result['data'] as $key => $value) {
        $idTwitter = $value['id']; //O identificador exclusivo do Tweet solicitado
        $texto = $value['text']; //O texto do Tweet solicitado
        $idUser = $value['author_id']; //O identificador exclusivo do usuário que criou o Tweet solicitado
        $verificado = isset($result['includes']['users'][$key]['verified']) ? $result['includes']['users'][$key]['verified'] : false; //Indica se o usuário que criou o Tweet solicitado é verificado
        $foto_perfil =  isset($result['includes']['users'][$key]['profile_image_url']) ? $result['includes']['users'][$key]['profile_image_url'] : false; //URL da foto de perfil do usuário que criou o Tweet solicitado
        $localizacao = isset($result['includes']['users'][$key]['location']) ? $result['includes']['users'][$key]['location'] : false; //Localização do usuário que criou o Tweet solicitado
        //CONVERTER DATA PARA O HORARIO BRAZILEIRO
        $data = new DateTime($value['created_at']); //Data de criação do Tweet solicitado
        $data->setTimezone(new DateTimeZone('America/Sao_Paulo')); //Definir Timezone
        $data = $data->format('d/m/Y H:i:s'); //Formatar Data

        $metricas_perfil = isset($result['includes']['users'][$key]['public_metrics']) ? $result['includes']['users'][$key]['public_metrics'] : false; //Métricas do usuário que criou o Tweet solicitado
        $seguidores = isset($metricas_perfil['followers_count']) ? $metricas_perfil['followers_count'] : false; //Número de seguidores do usuário que criou o Tweet solicitado
        $curtidas = isset($metricas_perfil['following_count']) ? $metricas_perfil['following_count'] : false; //Número de curtidas do usuário que criou o Tweet solicitado
        $retweets = isset($metricas_perfil['tweet_count']) ? $metricas_perfil['tweet_count'] : false; //Número de retweets do usuário que criou o Tweet solicitado
        $respostas = isset($metricas_perfil['listed_count']) ? $metricas_perfil['listed_count'] : false; //Número de respostas do usuário que criou o Tweet solicitado

        //URLs
        $urls = isset($value['includes']['users']['url']) ? $value['entities']['users']['url'] : false; //URLs do Tweet solicitado

        $nome = isset($value['includes']['users']['name']) ? $value['entities']['users']['name'] : false; //Nome do usuário que criou o Tweet solicitado
        
        if (isset($result['includes']['users'][$key]['username'])) {
            $username = $result['includes']['users'][$key]['username']; //O nome de usuário do usuário que criou o Tweet solicitado
        } else {
            $username = 'Não encontrado';
        }
        if ($verificado == true) {
            $pVeri = ' <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
              </svg>'; //O nome do usuário que criou o Tweet solicitado
        } else {
            $pVeri = '';
        }
        while ($i < 4 ) {
            echo '<div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-12">
                <div class="card-header">
                    <img src="' . $foto_perfil . '" class="rounded-circle" width="50" height="50" alt="...">
                    <span class="fw-bold">' . $username . '</span>
                    ' . $pVeri . '
                    <! -- link instagram onclick -- > 
                    <a href="'.$urls.'" target="_blank" class="btn btn-outline-primary btn-sm float-end"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
                  </svg></a>
                </div>
                <div class="card-body">
                    <p class="card-text">' . $texto . '</p>               
                </div>
                <div class="card-footer">
                    <span class="badge bg-success" class="fw-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                    <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
                  </svg> ' . number_format($retweets, 0, '.', '.') . '</span>
                  <span class="badge bg-primary" class="fw-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                </svg>' . number_format($seguidores, 0, '.', '.') . '</span>
                  <span class="badge bg-success" class="fw-light"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-thumbs-up-fill" viewBox="0 0 16 16">
                  <path d="M6.956 1.745C7.021.81 7.908.087 8.864.325l.261.066c.463.116.874.456 1.012.965.22.816.533 2.511.062 4.51a9.84 9.84 0 0 1 .443-.051c.713-.065 1.669-.072 2.516.21.518.173.994.681 1.2 1.273.184.532.16 1.162-.234 1.733.058.119.103.242.138.363.077.27.113.567.113.856 0 .289-.036.586-.113.856-.039.135-.09.273-.16.404.169.387.107.819-.003 1.148a3.163 3.163 0 0 1-.488.901c.054.152.076.312.076.465 0 .305-.089.625-.253.912C13.1 15.522 12.437 16 11.5 16H8c-.605 0-1.07-.081-1.466-.218a4.82 4.82 0 0 1-.97-.484l-.048-.03c-.504-.307-.999-.609-2.068-.722C2.682 14.464 2 13.846 2 13V9c0-.85.685-1.432 1.357-1.615.849-.232 1.574-.787 2.132-1.41.56-.627.914-1.28 1.039-1.639.199-.575.356-1.539.428-2.59z"/>
                </svg> ' . number_format($curtidas, 0, '.', '.') . '</span>
                <p class="card-text">' . $data . ' ' . $localizacao . ' '.$nome.'</p>
                  </div>
            </div>
        </div>
        </div>';

            $i++;
            break;
        }
    }
}
