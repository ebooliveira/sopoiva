<?php
class NotificaoTelegram
{
    public function __construct()
    {
        $this->token = '5541456834:AAGuF_MPMx1IQE5QvbLXb876eZa4RrIHXUU';
        $this->chat_id = '-670050937';
    }

    public function sendMessage($message)
    {
        $url = 'https://api.telegram.org/bot' . $this->token . '/sendMessage?chat_id=' . $this->chat_id . '&text=' . $message;
        $ch = curl_init();
        $optArray = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $optArray);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

//spl_autoload_register Class notificadorBootstrap

