<?php 
require_once ROOT_PATH . "classes/Translate.php";
require_once ROOT_PATH . "classes/SpeechToText.php";
require_once ROOT_PATH . "classes/TextToSpeech.php";
require_once ROOT_PATH . "classes/LinkYt.php";
require_once ROOT_PATH . "classes/Bitly.php";



$testo = "";
$testEn = "";
$vttIt = "";
$vttEn= "";
$vttEs= "";
$vttFr= "";
$vttZh = "";
$tot = 0;

$cont = 0;

if(isset($_POST["submit"])){

	echo "<script>";
	echo 'var timer = document.getElementById("timer");';
    echo 'var seconds = 0;';
    echo 'setInterval(function() {';
    echo 'timer.innerHTML = seconds++;';
    echo '}, 1000);';
	echo "</script>";

	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Cache-Control: no-cache");
	header("Pragma: no-cache");
	$stileTimeStamp = "";

	$translate = new Translate();
	$textToSpeech = new TextToSpeech();
    $speechToText = new SpeechToText();
	$getLinkYt = new LinkYt();
	$zip = new ZipArchive();
	$bitly = new Bitly();

	$jsonText = $speechToText->getText($idVideo); //chiedo all api di darmi il testo del video(include Time-stamp)

	foreach($jsonText as $word){
             $testo .= $word->text . " "; //mi costruisco il testo comleto senza timestamp
    }


	$testiTradotto = $translate->translate($testo, "en", "it", "es", "fr", "zh"); //dal testo completo mi calcolo il testo tradotto in tutte le lingue


	foreach($testiTradotto as $testo_tradotto){
		$lingua = $testo_tradotto->tl; //vedo qual'è la lingua del testo che il foreach sta eseguendo
		switch ($lingua) { //in base alla lingua lo assegno alla variabile che lo riguarda
			case 'it':
				$testoIt = $testo_tradotto->texts;
				break;
			case 'en':
				$testoEn = $testo_tradotto->texts;
				break;
			case 'es':
				$testoEs = $testo_tradotto->texts;
				break;
			case 'fr':
				$testoFr = $testo_tradotto->texts;
				break;
			case 'zh':
				$testoZh = $testo_tradotto->texts;
				break;
		}
	}
/*
//ITALIANO
	$testoIt = urlencode($testoIt);
	$audioIt = $textToSpeech->getAudio($testoIt, "it-IT-ElsaNeural");

//INGLESE
	$testoEn = urlencode($testoEn);
	$audioEn = $textToSpeech->getAudio($testoEn, "en-US-AriaNeural");
	
//FRANCESE
	$testoFr = urlencode($testoFr); 
	$audioFr = $textToSpeech->getAudio($testoFr, "fr-FR-DeniseNeural");

//SPAGNOLO
	$testoEs = urlencode($testoEs);
	$audioEs = $textToSpeech->getAudio($testoEs, "es-ES-ElviraNeural");

//CINESE 
	//$testoZh = urlencode($testoZh); 
	//$AudioZh = $textToSpeech->getAudio($testoZh, "zh-CN-XiaoxiaoNeural");
*/
	//var_dump($jsonText);

	echo '<div class="input-group mt-5" style="">';
		echo '<span class="input-group-text">Testo completo IT</span>';
		echo '<textarea class="form-control" aria-label="textarea">' . urldecode($testo) . '</textarea>';
	echo '</div>';

	echo '<div class="input-group mt-5" style="">';
		echo '<span class="input-group-text">Testo completo EN</span>';
		echo '<textarea class="form-control" aria-label="textarea">' . urldecode($testoEn) . '</textarea>';
	echo '</div>';

	echo '<div class="input-group mt-5" style="">';
		echo '<span class="input-group-text">Testo completo FR</span>';
		echo '<textarea class="form-control" aria-label="textarea">' . urldecode($testoFr) . '</textarea>';
	echo '</div>';

	echo '<div class="input-group mt-5" style="">';
		echo '<span class="input-group-text">Testo completo ES</span>';
		echo '<textarea class="form-control" aria-label="textarea">' . urldecode($testoEs) . '</textarea>';
	echo '</div>';


	$lungArray = count($jsonText)-1;
	foreach($jsonText as $element){
		$_SESSION["tempo"] = time();
   			echo date("H:i:s", (time() - ($_SESSION["tempo"])));
			echo date("d/m/Y");
			$text = $element->text;
	 			
			echo ' <div style=" ' . $stileTimeStamp . ' " class="input-group mt-5"> ';
			echo ' <span style="width:50px" class="input-group-text">' . $cont . '</span> ' ;
			echo ' <textarea class="form-control" aria-label="textarea">' . $text . '</textarea>';
			echo ' <span style="width:150px" class="input-group-text">Start:&nbsp <b> ' . $element->start . '</b></span> ';
			echo ' <span style="width:150px" class="input-group-text">End:&nbsp <b>' . $element->end . '</b></span> ';
			echo ' <span style="width:150px" class="input-group-text">Dur:&nbsp <b>' . $element->dur . '</b></span> ';
			echo ' </div> ';

			echo '<script>';
			echo 'var elem = document.getElementById("myBar");';
			echo 'var elem2 = document.getElementById("myBarNumber");';
			echo 'elem.style.width = "' . number_format(($cont/$lungArray)*100) .'%";';
			echo 'elem2.innerHTML = "' . number_format(($cont/$lungArray)*100) .'%";';
			echo '</script>';

			$cont++;

			//Ora per ogni parte di testo eseguo la traduzione in tutte le lingue e lo converto in audio
	
			
			$textTradotto = $translate->translate($text, "en", "it", "es", "fr", "zh"); //TRADUZIONE 
			foreach($textTradotto as $testo_tradotto){
				$lingua = $testo_tradotto->tl;
				switch ($lingua) {
					case 'it':
						$textIt = $testo_tradotto->texts;
						$textIt = urldecode($textIt);
						break;
					case 'en':
						$textEn = $testo_tradotto->texts;
						break;
					case 'es':
						$textEs = $testo_tradotto->texts;
						break;
					case 'fr':
						$textFr = $testo_tradotto->texts;
						break;
					case 'zh':
						$textZh = $testo_tradotto->texts;
						break;
				}
			}


			
			//ITALIANO
			$textIt = urlencode($textIt);
			$audioIt = $textToSpeech->getAudio($textIt, "it-IT-ElsaNeural");
			$textIt = urldecode($textIt);

			//INGLESE
			$textEn = urlencode($textEn);
			$audioEn = $textToSpeech->getAudio($textEn, "en-US-AriaNeural");
			$textEn = urldecode($textEn);
			
			//FRANCESE
			$textFr = urlencode($textFr); 
			$audioFr = $textToSpeech->getAudio($textFr, "fr-FR-DeniseNeural");
			$textFr = urldecode($textFr);

			//SPAGNOLO
			$textEs = urlencode($textEs);
			$audioEs = $textToSpeech->getAudio($textEs, "es-ES-ElviraNeural");
			$textEs = urldecode($textEs);

			//CINESE 
			//$testoZh = urlencode($testoZh); 
			//$AudioZh = $textToSpeech->getAudio($testoZh, "zh-CN-XiaoxiaoNeural");
			
			echo '<div class="col-sm-4 col-sm-offset-4 embed-responsive embed-responsive-4by3 mt-4">';
			echo '<h4>Audio Italiano</h4>';
				echo '<audio controls class="">';
					echo '<source src="' . $audioIt . '" type="audio/ogg"> ';
					echo '<source src="' . $audioIt . '" type="audio/mpeg"> ';
					echo 'Your browser does not support the audio tag.';
				echo '</audio>';
			echo '</div>';

			echo '<div class="col-sm-4 col-sm-offset-4 embed-responsive embed-responsive-4by3 mt-4">';
			echo '<h4>Audio Inglese</h4>';
				echo '<audio controls class="">';
					echo '<source src="' . $audioEn . '" type="audio/ogg"> ';
					echo '<source src="' . $audioEn . '" type="audio/mpeg"> ';
					echo 'Your browser does not support the audio tag.';
				echo '</audio>';
			echo '</div>';

			echo '<div class="col-sm-4 col-sm-offset-4 embed-responsive embed-responsive-4by3 mt-4">';
			echo '<h4>Audio Francese</h4>';
				echo '<audio controls class="">';
					echo '<source src="' . $audioFr . '" type="audio/ogg"> ';
					echo '<source src="' . $audioFr . '" type="audio/mpeg"> ';
					echo 'Your browser does not support the audio tag.';
				echo '</audio>';
			echo '</div>';

			echo '<div class="col-sm-4 col-sm-offset-4 embed-responsive embed-responsive-4by3 mt-4">';
			echo '<h4>Audio Spagnolo</h4>';
				echo '<audio controls class="">';
					echo '<source src="' . $audioEs . '" type="audio/ogg"> ';
					echo '<source src="' . $audioEs . '" type="audio/mpeg"> ';
					echo 'Your browser does not support the audio tag.';
				echo '</audio>';
			echo '</div>';

			$start = $element->start;
			$end = $element->end;
			$vttIt .= gmdate("H:i:s", $start) . ".000 --> ". gmdate("H:i:s", $end) . ".000" . "\n" . $textIt . "\n";
			$vttEn .= gmdate("H:i:s", $start) . ".000 --> ". gmdate("H:i:s", $end) . ".000" . "\n" . $textEn . "\n";
			$vttEs .= gmdate("H:i:s", $start) . ".000 --> ". gmdate("H:i:s", $end) . ".000" . "\n" . $textEs . "\n";
			$vttFr .= gmdate("H:i:s", $start) . ".000 --> ". gmdate("H:i:s", $end) . ".000" . "\n" . $textFr . "\n";
			//$vttZh .= gmdate("H:i:s", $start) . ".000 --> ". gmdate("H:i:s", $end) . ".000" . "\n" . $textZh . "\n";
			
	}

	$subIt = ['WEBVTT', $vttIt];
	$subEn = ['WEBVTT', $vttEn];
	$subEs = ['WEBVTT', $vttEs];
	$subFr = ['WEBVTT', $vttFr];
	//$subZh = ['WEBVTT', $vttZh];
	file_put_contents(ROOT_PATH . "sottotitoli/ittrack.vtt", implode("\n", $subIt));
	file_put_contents(ROOT_PATH . "sottotitoli/entrack.vtt", implode("\n", $subEn));
	file_put_contents(ROOT_PATH . "sottotitoli/estrack.vtt", implode("\n", $subEs));
	file_put_contents(ROOT_PATH . "sottotitoli/frtrack.vtt", implode("\n", $subFr));
	//file_put_contents(ROOT_PATH . "sottotitoli/zhtrack.vtt", implode("\n", $subZh));
	
	
	$linkYt = $getLinkYt->getLink($idVideo);
	$linkBitly = $bitly->getLink($linkYt);
	

	
	$remote_file = ($linkBitly);
	$local_folder = ROOT_PATH . "sottotitoli/";
	$remote_file_open = fopen($remote_file, 'r');

	$local_file_name = basename($remote_file);
	//var_dump(fopen($local_folder.$local_file_name.".mp4",'w'));
	if (($file = fopen($local_folder.$local_file_name . ".mp4",'w'))){
		//$lng = fread($remote_file_open, 8192);
		//var_dump($lng);
		while ($dimensione = fread($remote_file_open, 8192)) {
			$tot += strlen($dimensione);
		}
		fclose($remote_file_open);
		fclose($file);
	}
	

	
	$remote_file = ($linkBitly);
		
	$local_folder = ROOT_PATH . "sottotitoli/";
	$remote_file_open = fopen($remote_file, 'r');

	$local_file_name = basename($remote_file);
	//var_dump(fopen($local_folder.$local_file_name.".mp4",'w'));
	if (($file = fopen($local_folder.$local_file_name . ".mp4",'w'))){
		while ($file_op = fread($remote_file_open, 8192)) {
			 	$dmsScaricata += strlen($file_op);
				fwrite($file, $file_op, strlen($file_op));
				//var_dump($prova);
				echo '<script>';
				echo 'var elem = document.getElementById("myBar2");';
				echo 'var elem2 = document.getElementById("myBarNumber2");';
				echo 'elem.style.width = "' . number_format(($dmsScaricata/$tot)*100) .'%";';
				echo 'elem2.innerHTML = "' . number_format(($dmsScaricata/$tot)*100) .'%";';
				echo '</script>';
		}
		fclose($remote_file_open);
		fclose($file);
	}
	
	//ITALIANO
	$testoIt = urlencode($testoIt);
	$audioIt = $textToSpeech->getAudio($testoIt, "it-IT-ElsaNeural");

	//INGLESE
		$testoEn = urlencode($testoEn);
		$audioEn = $textToSpeech->getAudio($testoEn, "en-US-AriaNeural");
		
	//FRANCESE
		$testoFr = urlencode($testoFr); 
		$audioFr = $textToSpeech->getAudio($testoFr, "fr-FR-DeniseNeural");

	//SPAGNOLO
		$testoEs = urlencode($testoEs);
		$audioEs = $textToSpeech->getAudio($testoEs, "es-ES-ElviraNeural");

	unlink(ROOT_PATH . "sottotitoli/file.zip");
	$zip->open(ROOT_PATH . "sottotitoli/file.zip", ZipArchive::CREATE);
	$zip->addFile(ROOT_PATH . "sottotitoli/entrack.vtt", 'entrack.vtt');
	$zip->addFile(ROOT_PATH . "sottotitoli/ittrack.vtt", 'ittrack.vtt');
	$zip->addFile(ROOT_PATH . "sottotitoli/frtrack.vtt", 'frtrack.vtt');
	$zip->addFile(ROOT_PATH . "sottotitoli/estrack.vtt", 'estrack.vtt');
	//$zip->addFile(ROOT_PATH . "sottotitoli/" . $local_file_name . ".mp4", $local_file_name . ".mp4");
	$zip->close();

	echo 'timer.innerHTML = "0"';

}