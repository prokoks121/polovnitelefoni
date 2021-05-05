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
	$user=$_GET['user_id'];

	 $stm = $conns->prepare("SELECT * FROM users WHERE `confirmation_code`= ? AND `username`=? AND `confirmation`='0'");
    $stm->execute([$conf,$user]);
	if ($stm->rowCount() != '0') {
	
	if (isset($_SESSION['user']['id'])) {
		$_SESSION['user']['confirmation'] = '1';
	}
	$stm = $conns->prepare("UPDATE `users` SET `confirmation`='1' WHERE `confirmation_code`=? AND `username`=? LIMIT 1");
	
	if($stm->execute([$conf,$user])){
	echo "<script type='text/javascript'>window.location.reload(true); </script>";
}
}else{
	 $stm = $conns->prepare("SELECT * FROM users WHERE `confirmation_code`=? AND `username`=? AND `confirmation`='1'");
    $stm->execute([$conf,$user]);
	if ($stm->rowCount() != '0') {
		$result = $stm->fetch(PDO::FETCH_BOTH);

	echo "<div><h1 style='color: green;    text-align: center;'>Verifikovali ste vas nalog ".$result['email'].".</h1></div>";
	}
}

}











 ?>

		</div>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	