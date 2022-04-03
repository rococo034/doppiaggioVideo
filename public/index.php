<?php

if ($page = isset($_GET["page"])) {
    $page = $_GET["page"];
}else{
    $page = 'homepage';
}

?>
<?php include '../inc/init.php'?>
<?php include ROOT_PATH .  'public/template-parts/header.php'?>

<div id="main" class="container">

<div class="row">

    <div class="col-8">
    <?php include ROOT_PATH . 'public/pages/' . $page . '.php'?>
    </div>

    <?php include ROOT_PATH . 'public/template-parts/sidebar.php'?>
  </div>

  <?php include ROOT_PATH .  'public/template-parts/footer.php'?>

  