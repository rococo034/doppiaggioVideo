<?php
class Translate{

    function __construct(){

    }

	public function translate($text, $lng1, $lng2, $lng3, $lng4, $lng5){
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => "https://google-translate54.p.rapidapi.com/translates",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "{\n    \"texts\": [\"$text\"],\n    \"tls\": [\"$lng1\",\"$lng2\",\"$lng3\",\"$lng4\",\"$lng5\"]}",
			CURLOPT_HTTPHEADER => [
				"X-RapidAPI-Host: google-translate54.p.rapidapi.com",
				"X-RapidAPI-Key: f71f6838d8mshdb0794cf81a2c0ap1e7963jsnb3b3c8b471e5",
				"content-type: application/json"
			],
		]);
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			$result = json_decode($response);
			return $result;
		}
	}
 }