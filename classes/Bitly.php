<?php
require ROOT_PATH . 'vendor/autoload.php';
use Bitly\BitlyClient;


class Bitly{
    function __construct(){
    }

    public function getLink($link){
        //$link = urlencode($link);
        $bitlyClient = new BitlyClient('35842ab20bcb03bdc339b35fff8159cdedcdb1b2');
        $options = [
            'longUrl' => $link,
            'format' => 'json' 
        ];
        $response = $bitlyClient->shorten($options);
        return $response->data->url;
        
    }
}
