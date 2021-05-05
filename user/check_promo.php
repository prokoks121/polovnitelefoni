<?php
include '../config.php';

global $conns;
$echo = [];
$check = $_POST['code'];
$user_id = $_SESSION['user']['id'];

            $stm = $conns->prepare("SELECT id FROM promo_code WHERE code=? AND repeats!=0");
            $stm->execute([$check]);

if ($stm->rowCount() > 0) {
	$stm = $conns->prepare("SELECT id FROM promo_code_repeat WHERE code=? AND user_id=?");
            $stm->execute([$check,$user_id]);
	if ($stm->rowCount() == 0) {
			$check_code = true;
	array_push($echo, $check_code);

	}else{
	$check_code = false;
	array_push($echo, $check_code);
	array_push($echo, "Kod mozete samo jednom da iskoristite.");

}
}else{
	$check_code = false;
	array_push($echo, $check_code);

	array_push($echo, "Kod je neispravan.");

}



echo json_encode($echo);


 ?>

