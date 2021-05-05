<?php
include 'config.php';
if (isset($_SESSION['user']['id'])) {


global $conns;
$follow = $_POST['options'];
$user_id = $_SESSION['user']['id'];
$post_slug = $_SESSION['url']['id'];



$stm = $conns->prepare("SELECT * FROM follow WHERE id_user=? AND id_post=? AND 1");
        $stm->execute([$user_id,$post_slug]);
$num_rows = $stm->rowCount();
if ($num_rows > 0) {
$r = "<p id='heart' href='#' class='fas fa-heart fsts' style='color: red;cursor: pointer;'></p>";
}else{
$r = "<p id='heart' href='#' class='fas fa-heart fsts' style='color: #14264e;cursor: pointer;'></p>";
}
}else{
	$r = "<p id='heart' href='#' class='fas fa-heart fsts' style='color: #14264e;cursor: pointer;'></p>";
}
echo $r;
?>
