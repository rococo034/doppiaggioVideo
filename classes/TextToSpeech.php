<?php

class TextToSpeech{

    function __contruct(){

    }

    public function getAudio($testoIt, $voce){
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://microsoft-edge-text-to-speech.p.rapidapi.com/TTS/EdgeTTS?text=$testoIt&voice_name=$voce",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "X-RapidAPI-Host: microsoft-edge-text-to-speech.p.rapidapi.com",
                "X-RapidAPI-Key: f71f6838d8mshdb0794cf81a2c0ap1e7963jsnb3b3c8b471e5"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response);
            $AudioIta = $result->downloadUrl;
            return $AudioIta;
        }
    }

}