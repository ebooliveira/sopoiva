<?php
require_once '/xampp/htdocs/sopoiva/api/ApiTwitter.php';
$api = new ApiTwitter();
$result = $api->PesquisarTweets();
$result = json_decode($result);
array(
    'tweets' => $result->data,
    'users' => $result->includes->users
);
//exibir os 10 primeiros tweets
for ($i = 0; $i < 2; $i++) {
    echo $result->data[$i]->text . '<br>';
    echo "Nome: " . $result->includes->users[$i]->name . '<br>';
    echo "Usuário: @" . $result->includes->users[$i]->username . '<br>';
    //Mostra img do usuário
    echo "Foto: " . '<img src="' . $result->includes->users[$i]->profile_image_url . '" width="50" height="50" alt="...">' . '<br>';
    echo "Descrição: " . $result->includes->users[$i]->description . '<br>';
    if (isset($result->includes->users[$i]->location)) {
        echo "Localização: " . $result->includes->users[$i]->location . '<br>';
    } else {
        echo "Localização: Não informada" . '<br>';
    }
    echo '<table border="1">';
    echo '<tr>';
    echo '<td>Seguidores</td>';
    echo '<td>Seguindo</td>';
    echo '<td>Tweets</td>';
    echo '<td>Verficado</td>';
    echo '<td>Perfil</td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td>' . $result->includes->users[$i]->public_metrics->followers_count . '</td>';
    echo '<td>' . $result->includes->users[$i]->public_metrics->following_count . '</td>';
    echo '<td>' . $result->includes->users[$i]->public_metrics->tweet_count . '</td>';
    if ($result->includes->users[$i]->verified == true) {
        echo '<td>Sim</td>';
    } else {
        echo '<td>Não</td>';
    }
    echo '<td><a href="https://twitter.com/' . $result->includes->users[$i]->username . '" target="_blank">Perfil</a></td>';
    echo '</tr>';
    echo '</table>';
    echo '<br>';
    $data = $result->data[$i]->created_at; //2021-12-01T23:59:59.000Z
    date_default_timezone_set('America/Sao_Paulo'); //Fuso horário de São Paulo
    $data = date('d/m/Y H:i:s', strtotime($data)); //Converte a data e hora para o formato brasileiro
    echo "Publicado em: " . $data . '<br>'; //Exibe a data e hora
    echo '<hr>';
}
    
    
//var_dump($result->includes);
