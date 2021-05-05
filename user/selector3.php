<?php
include '../config.php';
global $conns;
    $selStudent = $_POST['theOption'];
  
$stm = $conns->prepare("SELECT * FROM phones WHERE id=?");
        $stm->execute([$selStudent]);

    $image = $stm->fetch(PDO::FETCH_BOTH);
$img = "<img src='/static/images/modeli/" . $image['photo'] . "'/>";
    echo $img;
    ?>