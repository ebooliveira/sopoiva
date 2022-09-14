<?php
require __DIR__ . '/../api/ApiTwitter.php';
$api = new ApiTwitter();
$result = $api->PesquisarTweets();
$result = json_decode($result);
array(
    'tweets' => $result->data,
    'users' => $result->includes->users
);
function exibirTweets($result)
{
    //LISTCARD DO TWITTER PARA EXIBIR OS TWEETS 1 POR 3
    $tweets = $result->data;
    $users = $result->includes->users;
    $i = 0;

    foreach ($tweets as $tweet) {
        $user = $users[$i];
        $i++;
        if ($i < 3) {
        
        $date = date_create($tweet->created_at);
        $date = date_format($date, 'd/m/Y H:i');
        $text = $tweet->text;
        $text = str_replace('https://t.co/', '', $text);
        $text = str_replace('http://t.co/', '', $text);
        $text = str_replace('https://', '', $text);
        $text = str_replace('http://', '', $text);
        $text = str_replace('www.', '', $text);
        $text = str_replace(' ', '', $text);

        echo '
        <div class="card text-center">
            <div class="card-body p-3 mb-2 bg-dark text-white">
                <div class="row">
                    <div class="col-2">
                        <img src="' . $user->profile_image_url . '" class="img-fluid" alt="...">
                    </div>
                    <div class="col-10">
                        <h5 class="card-title">' . $user->name . '</h5>
                        <p class="card-text">' . $text . '</p>
                        <p class="card-text">' . $date . '</p>
                    </div>
                </div>
            </div>
        </div>
        ';
    }
}
}
    
//var_dump($result->includes);
