<?php
    if(isset($_POST["linkyt"])){
        $linkYt = $_POST["linkyt"];
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
    <form action="" method="post">
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">Link Youtube</span>
        <input type="text" name="linkyt" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
    </div>
    </form>
</center>

<iframe id="buttonApi" src="https://yt-download.org/api/button/mp3?url=<?php echo $linkYt?>"
width="100%" height="100%" allowtransparency="true" scrolling="no" style="border:none"></iframe>

<h5><a href="<?php echo ROOT_URL . "/public/?page=insert_mp3"?>">Inserisci il file mp3</a></h5>
