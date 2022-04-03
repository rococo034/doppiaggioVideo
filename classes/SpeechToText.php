<?php

class SpeechToText{
    function __construct(){

    }


    public function getText($idVideo){
        $testo = "";
        $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://subtitles-for-youtube.p.rapidapi.com/subtitles/" . $idVideo,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "X-RapidAPI-Host: subtitles-for-youtube.p.rapidapi.com",
            "X-RapidAPI-Key: f71f6838d8mshdb0794cf81a2c0ap1e7963jsnb3b3c8b471e5"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $resultEnd = json_decode($response);
        return $resultEnd;
    }
    }

}