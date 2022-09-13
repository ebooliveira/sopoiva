<?php
class ApiTwitter
{
    public function __construct()
    {
        $this->ApiKey = 'Sq1HC8MASeNSbguWMHjjTzNSi';
        $this->ApiKeySecret = 'oGPZ5ET1Q3df74x6GVIeZ0V5otrl1J3kvTAcv1vttsTSOWb7ec';
        $this->BearerToken = 'AAAAAAAAAAAAAAAAAAAAANAnhAEAAAAA7x0Qazh%2BI0H4JQclxEvtR6bHxYE%3DaDng8h6Y4zsBnDfsXV19cBsvTNeDW5YmsdgS1wCTHHixBQlyYz';
        $this->accessToken = '1199143517072875521-XRjADrdo3aySgB3VRXmdo8Hx4cLJAw';
        $this->accessTokenSecret = '3MnrOpJQ3ntzNRW3rjSpBLaQ64580Bscp0MG5FJpnaFZc';
    }
    public function PesquisarTweets()
    {
        $url = 'https://api.twitter.com/2/tweets/search/recent?query=CartolaFc%20OR%20Brasileir%C3%A3o2022&tweet.fields=author_id,created_at,entities,geo,in_reply_to_user_id,lang,possibly_sensitive,referenced_tweets,source,text,withheld&expansions=author_id,geo.place_id,in_reply_to_user_id,referenced_tweets.id,referenced_tweets.id.author_id&user.fields=created_at,description,entities,id,location,name,pinned_tweet_id,profile_image_url,protected,public_metrics,url,username,verified,withheld&place.fields=contained_within,country,country_code,full_name,geo,id,name,place_type&max_results=100';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $this->BearerToken
        ));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
