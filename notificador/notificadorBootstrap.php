<?php
function enviarMsg(){
    //Enviar Mensagem Whatsapp
    $token = 'token';
    $numero = 'numero';
    $mensagem = 'mensagem';
    $url = 'https://api.callmebot.com/whatsapp.php?phone='.$numero.'&text='.$mensagem.'&apikey='.$token;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $resposta = curl_exec($ch);
    curl_close($ch);
    echo $resposta;

    //Enviar Mensagem Telegram
    $token = '5541456834:AAFWwVUA9VCd4uRtpgz2u8ZOvHJ25aUqWEE';
    $chat_id = 'chat_id';
    $mensagem = 'mensagem';
    $url = 'https://api.telegram.org/bot'.$token.'/sendMessage?chat_id='.$chat_id.'&text='.$mensagem;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $resposta = curl_exec($ch);
    curl_close($ch);
    echo $resposta;

    
}
