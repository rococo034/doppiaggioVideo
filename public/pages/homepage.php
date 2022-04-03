<?php
$spinner = "none";
$isOkFile = false;
$errMsg = "";
if(isset($_POST["submit"])){
    $spinner = "";
    $uploadDir = "/Applications/XAMPP/xamppfiles/htdocs/lav/" . 'file_audio';
    $strRandom = substr(md5(mt_rand()), 0, 20);
    $isOkFile = false;
        foreach ($_FILES as $file) {
            if ($file["size"] == 0) {
                $noFile = true;
            }else{
                $tipo = $file["type"];
                $size = $file["size"];
                if ($size<=200000 && UPLOAD_ERR_OK === $file['error'] && $tipo=="audio/mpeg" )  {
                    $fileName = basename($file['name']);
                    move_uploaded_file($file['tmp_name'], $uploadDir.'/'.$strRandom.$fileName);
                    $path = 'localhost/lav/'.'file_audio/'.$strRandom.$fileName;
                    $path2 = "/Applications/XAMPP/xamppfiles/htdocs/lav/file_audio/".$strRandom.$fileName;
                    $isOkFile = true;
                }else{
                    $errMsg = "Errore nel caricamento del file";
                }
    
            }
    
        }
}



?>
<script>
    
    function spinner() {
        //alert("ciao");
        document.getElementById("spinner").style.display = "";
  }
</script>
<center>
    <h2 class="mt-4">Inserisci un file</h2>
</center>

<form action="" method="post" enctype="multipart/form-data">
    <div class="input-group mb-3 mt-4">
        <input required type="file" class="form-control" name="fileToUpload" id="fileToUpload">
        <input class="input-group-text" onclick="spinner()" type="submit" value="Upload" name="submit">
    </div>
    <div>
        <h6 style="color: red"><?php echo $errMsg?></h6>
        <div class="text-center text-primary">
        <div style="display: none" id="spinner" class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        </div>
    </div>
</form>



<?php require_once ROOT_PATH . 'inc/translate.php' //importo il file che fa la call all'api?> 