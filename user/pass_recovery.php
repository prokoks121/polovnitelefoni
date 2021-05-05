<?php require_once('../config.php') ?>
<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>

<?php
if (isset($_SESSION['user']['id'])) {
header("location: /user/user");
}
 ?>
	<title>Povrati šifru | PolovniTelefoni.net</title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container">

		<div class="content" style="min-height: 700px;
    text-align: center;">
		
			<div style="    padding-top: 70px;">
				<p style="padding-bottom: 16px;">Zaboravili ste sifru ili korisnicko ime?</br>Mi vam mozemo pomoci u samo par koraka...</p>
				<div>
					<h2 style="padding-bottom: 20px;">Unesite email adresu vaseg nalog</h2>
					
					<form  method="post">
						<input class="login-input" type="email" name="mail" placeholder="example@gmail.com">
						<button style="    cursor: pointer;
    -webkit-appearance: none;
    background: #14264e;
    border: none;
  
    font-family: 'Source Sans Pro',sans-serif;
    color: white;
   
    border-radius: 2px;
    margin: 20;
    padding: 14px 21px;" name="submit_rec">Dalje</button>

					</form>
					<p style="padding-top: 10px;">Na ovaj email ce stici kod za oporavak vaseg naloga</p>
				</div>
				<?php if (isset($_GET['send']) && isset($_GET['email'])): ?>
					<?php if ($_GET['send'] == 'true'): ?>
						<h2 style="color: green;">Uspešno ste poslali kod za oporavak vaše lozinek!</h2>
						<p>Sve što treba da uradite jeste da pristupite email adresi <?php echo $_GET['email'];?> i u inbox će vam stići poruka sa linkom.</br>Kada pritisnete na taj link, otvoriće vam se prozor gde ćete moći uneti novu šifru.</p>
					<?php endif ?>

					
					<?php if ($_GET['send'] == 'false'): ?>
						<h2 style="color: red;">Kod za oporavak lozinke je vec poslat na vaš email!</h2>
						<p>Ovu funkciju možete da upotrebite ponov tek dan posle slanja prvobitnog koda za oporavak na vaš email.</p>
					<?php endif ?>
					
				<?php endif ?>
				
			</div>

		</div>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	