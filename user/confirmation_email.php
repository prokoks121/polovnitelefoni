<?php require_once('../config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>


	<title>Verifikacija | PolovniTelefoni.net</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container">

		<div class="content">
<?php

global $conns;

if (isset($_GET['conf']) && isset($_GET['user_id'])) {
	$conf = $_GET['conf'];
	$user_id=$_GET['user_id'];
	  $stm = $conns->prepare("SELECT * FROM recovery WHERE `confirmation_code`=? AND `user_id`=? AND user='0011001200' LIMIT 1");
        $stm->execute([$conf,$user_id]);
	if ($stm->rowCount() != '0') {
		    $email = $stm->fetch(PDO::FETCH_ASSOC);
		$mail = $email['email'];
			 $stm = $conns->prepare("UPDATE users SET `email`= ? WHERE id=? LIMIT 1");
        $stm->execute([$mail,$user_id]);

			$stm = $conns->prepare("DELETE FROM recovery WHERE `confirmation_code`= ? AND `user_id`=? AND user='0011001200' LIMIT 1");
        $stm->execute([$conf,$user_id]);
$_SESSION['user']['email'] = $mail;
			header('location: /user/user');
}else{
	echo "Ovaj link je vec iskoriscen ili je doslo do neke goreske.</br>Ako i dalje budete dobijali ovu gresku molio vas da nas kontaktirate.";
	}


}
?>

		</div>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	