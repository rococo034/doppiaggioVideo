<?php
$curl = curl_init();

curl_setopt_array($curl, [
	CURLOPT_URL => "https://microsoft-edge-text-to-speech.p.rapidapi.com/TTS/VoicesList",
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
	
    $resultEnd = json_decode($response);

    
}
?>

<div class="container mt-5" style="width:33%">
    <center>
        <h3>Voci Disponibili</h3>
        <select class="form-select mt-3" aria-label="Default select example" name="" id="">
            <?php foreach($resultEnd->voices_list as $voice):?>
                <option value=""><?php echo $voice->voice_name ?></option>
            <?php endforeach; ?> 
        </select>
    </center>
		<video class="mt-4" style="width:100%" controls >
			<source src="<?php echo $linkYt?>" type="video/mp4">
			<track id="enTrack" src="<?php echo ROOT_URL?>sottotitoli/entrack.vtt" label="English" kind="captions" srclang="en" default>
			<track id="itTrack" src="<?php echo ROOT_URL?>sottotitoli/ittrack.vtt" label="Italiano" kind="captions" srclang="it">
			<track id="frTrack" src="<?php echo ROOT_URL?>sottotitoli/frtrack.vtt" label="Francese" kind="captions" srclang="fr">
			<track id="esTrack" src="<?php echo ROOT_URL?>sottotitoli/estrack.vtt" label="Spagnolo" kind="captions" srclang="es">
		</video>
		<center>
		<a href="<?php echo ROOT_URL?>sottotitoli/file.zip" class="list-group-item list-group-item-action active" aria-current="true">
			Scarica .zip
		</a>
		</center>
</div>



