<?php
    $stileTimeStamp = "display:none";
    $jsonText = array("");
    if(isset($_POST["linkyt"])){
        $linkYt = $_POST["linkyt"];
        $posStartId = strpos($linkYt, '?v=') + 3;
        $idVideo = substr($linkYt, $posStartId, strlen($linkYt));
    
    }
    
?>

<center>
    <h2 class="mt-4">Inserisci un link youtube</h2>
</center>

<form action="" method="post" >

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Link Youtube</span>
        <input required type="text" name="linkyt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        <input class="input-group-text" onclick="spinner()" type="submit" value="Upload" name="submit">
    </div>
    <span>Secondi trascorsi: <b id="timer">0</b></span>

    
    <div class="mt-4">
        <div class="text-center text-primary">
        <div style="display: none" id="spinner" class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        </div>

        <span class="mt-3">Progresso elaborazione video...</span>
        <div class="" id="myProgress">
            <div id="myBar"><center id="myBarNumber"></center></div>
        </div>

        <span class="mt-3">Progresso download per scaricare il file .zip</span>
        <div class="" id="myProgress2">
            <div id="myBar2"><center id="myBarNumber2"></center></div>
        </div>
    </div>
</form>



<?php require_once ROOT_PATH . 'inc/translate.php' //importo il file che fa le call alle api?> 



<!-- <?php //foreach($jsonText as $element): $cont++?>
    <div style="<?php //echo $stileTimeStamp?>" class="input-group mt-2" style="">
        <span style="width:150px" class="input-group-text"><?php //echo "Time-stamp " . $cont?></span>
        <textarea class="form-control" aria-label="textarea"><?php //echo $element->text?></textarea>
        <span style="width:150px" class="input-group-text"><?php //echo "Start: " . "<b>&nbsp&nbsp" . $element->start . "</b>"?></span>
        <span style="width:150px" class="input-group-text"><?php //echo "End: " . "<b>&nbsp&nbsp" . $element->end . "</b>"?></span>
        <span style="width:150px" class="input-group-text"><?php //echo "Dur: " . "<b>&nbsp&nbsp" . $element->dur . "</b>"?></span>
    </div>
<?php //endforeach;?> -->


<div class="col-sm-4 col-sm-offset-4 embed-responsive embed-responsive-4by3 mt-4">
    <h4>Audio Italiano</h4>
    <audio controls class="">
        <source src="<?php echo $audioIt?>" type="audio/ogg">
        <source src="<?php echo $audioIt?>" type="audio/mpeg">
        Your browser does not support the audio tag.
    </audio>
</div>


<div class="col-sm-4 col-sm-offset-4 embed-responsive embed-responsive-4by3 mt-4">
    <h4>Audio Inglese</h4>
    <audio controls class="">
        <source src="<?php echo $audioEn?>" type="audio/ogg">
        <source src="<?php echo $audioEn?>" type="audio/mpeg">
        Your browser does not support the audio tag.
    </audio>
</div>


<div class="col-sm-4 col-sm-offset-4 embed-responsive embed-responsive-4by3 mt-4">
    <h4>Audio Francese</h4>
    <audio controls class="">
        <source src="<?php echo $audioFr?>" type="audio/ogg">
        <source src="<?php echo $audioFr?>" type="audio/mpeg">
        Your browser does not support the audio tag.
    </audio>
</div>


<div class="col-sm-4 col-sm-offset-4 embed-responsive embed-responsive-4by3 mt-4">
    <h4>Audio Spagnolo</h4>
    <audio controls class="">
        <source src="<?php echo $audioEs?>" type="audio/ogg">
        <source src="<?php echo $audioEs?>" type="audio/mpeg">
        Your browser does not support the audio tag.
    </audio>
</div>


<div class="col-sm-4 col-sm-offset-4 embed-responsive embed-responsive-4by3 mt-4">
    <h4>Audio Cinese</h4>
    <audio controls class="">
        <source src="<?php// echo $audioZh?>" type="audio/ogg">
        <source src="<?php //echo $audioZh?>" type="audio/mpeg">
        Your browser does not support the audio tag.
    </audio>
</div>


<script>
    
    function spinner() {
        //alert("ciao");
        document.getElementById("spinner").style.display = "";
  }

    function modifySpinner(){
        var elem = document.getElementById("myBar");
        elem.style.width = "10%";
        elem.innerHTML = "10%";
    }
    

    
</script>