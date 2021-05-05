<?php require_once('../config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<?php
if (isset($_SESSION['user']['id'])) {
header("location: /user/user");
}
 ?>
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

	 $stm = $conns->prepare("SELECT * FROM recovery WHERE `confirmation_code`=? AND `user`=? LIMIT 1");
    $stm->execute([$conf,$user_id]);
	if ($stm->rowCount() != '0') {
			echo '    <h2 style="text-align: center;
    padding-top: 50px;">Popunite sledeca polja kako biste izvrsili oporavak vaseg naloga</h2>
<div style="    margin: auto;
    width: 302px;
    padding-top: 25px;
    padding-bottom: 50px;">

	<form method="post">
		<input class="login-input" type="password" name="password" placeholder="Unesi novu sifru">
		<input class="login-input" type="password" name="password1" placeholder="Ponovi sifru">
		<button class="btn" name="pass_sub">Sacuvaj lozinku</button>
	</form>
</div>';
}else{
	echo "Ovaj link je vec iskoriscen ili je doslo do neke goreske.</br>Ako i dalje budete dobijali ovu gresku molio vas da nas kontaktirate.";
	}


}
?>

		</div>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	