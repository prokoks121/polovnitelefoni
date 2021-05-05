<?php
include 'config.php';

global $conns;

$follow = $_POST['option'];
$user_id = $_SESSION['user']['id'];
$post_slug = $_SESSION['url']['id'];

 if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
    $stm = $conns->prepare("SELECT * FROM follow WHERE id_user=? AND id_post=? AND 1");
        $stm->execute([$user_id,$post_slug]);
$num_rows = $stm->rowCount();
if ($num_rows > 0) {
   $stm = $conns->prepare("DELETE FROM follow WHERE id_user=? AND id_post=?");
        $stm->execute([$user_id,$post_slug]);
$r = "<p id='heart' href='#' class='fas fa-heart' style='color: #14264e;cursor: pointer;'></p>";
}else{
 $stm = $conns->prepare("INSERT INTO follow (id_user,id_post,ip) VALUES(?, ?,?)");
        $stm->execute([$user_id,$post_slug,$ip]);
$r = "<p id='heart' href='#' class='fas fa-heart' style='color: red;cursor: pointer;'></p>";
}

echo $r;

?>