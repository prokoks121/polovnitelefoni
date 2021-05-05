
<?php foreach ($posts as $post): ?>
	<?php 
	$id_telefona = $post['id_telefona'];
global $conns,$errors;


    $stm = $conns->prepare("SELECT photo,marka,model FROM phones WHERE id=?");
    $stm->execute([$id_telefona]);
    $models = $stm->fetch(PDO::FETCH_ASSOC);



$user_id = $post['user_id'];


    $stm = $conns->prepare("SELECT telefon,telefon2 FROM users WHERE id=?");
    $stm->execute([$user_id]);
    $users = $stm->fetch(PDO::FETCH_ASSOC);




if ($post['starost'] != "Kao nov" AND $post['starost'] != "Nov") {
	$starost = "Polovan, Aktiviran: " . $post['starost'];

	
}else{$starost = $post['starost'];
}
if ($post['garancija'] == ""){
	$garancija = "Nema";
}else{
	$garancija = $post['garancija_tip'] . ", ". $post['garancija'];
}

if ($post['kabl'] == 0) {
$kabal = "";
}else{$kabal = " | Kabl";}
if ($post['adapter'] == 0) {
$adapter = "";
}elseif ($post['adapter'] == 1 && $post['kabl'] == 0) {
$adapter = " | Adapter";
}elseif ($post['adapter'] == 1 && $post['kabl'] == 1) {
$adapter = " | Adapter";}
if ($post['slusalice'] == 0) {
$slusalice = "";
}else{$slusalice = " | Slušalice";}
if ($post['kutija'] == 0) {
$kutija = "";
}else{$kutija = " | Kutija";}
if ($post['maska'] == 0) {
$maska = "";
}else{$maska = " | Maska";}


if ($post['mreza'] == 1) {
	$mreza = "Telefon je otključan na svim mrezama";
}
if ($post['mreza'] == 2) {
	$mreza = "Telefon je zaključan u mts-u";
}
if ($post['mreza'] == 3) {
	$mreza = "Telefon je zaključan u vip-u";
}
if ($post['mreza'] == 4) {
	$mreza = "Telefon je zaključan u telenor-u";
}
if ($post['body'] == '') {
	$text12 = "Nema opisa";
}else{$text12 = $post['body'];}



    $stm = $conns->prepare("SELECT * FROM company WHERE user_id=? LIMIT 1");
    $stm->execute([$user_id]);
     $company = $stm->fetch(PDO::FETCH_ASSOC);

     $grad = explode('%', $company['adresa']);


                                               $link = $models['marka'] . "-" . $models['model'];
$link = SplitWrods($link);
?>
				<div class="post" style="margin-top: 50px;" >
<a href="/single_post/<?php echo $link; ?>/<?php echo $post['id']; ?>" class="post_action_a">
					<div style="float: left;" >
						
					<img src="<?php echo  '/static/images/modeli/' . $models['photo']; ?>"  alt="">
					
					
					</div>
					<div class="post-right">
						<p>Stanje: <?php echo  $starost;?></p>
						<p>Garancija: <?php echo $garancija ?></p>
						<?php if ($post['kabl'] == 0 && $post['adapter'] == 0 && $post['slusalice'] == 0 && $post['kutija'] == 0 && $post['maska'] == 0 ) {
	$sve = "Nema prateće opreme";
	echo "<p style=margin: 5px 0px;>" . $sve . "</p>";
}else{
echo "<p style=margin: 5px 0px;>" . $kabal . $adapter . $slusalice . $kutija . $maska . "</p>";}
	?>
						
						<p><?php echo $mreza ?></p>

						<p>Opis telefona:</p>

						<p style="font-size: 15px;margin: 0px"><?php echo mb_strimwidth($text12, 0, 189, '...');?></p>
						

						</div>
				<div class="info" style="height: 83px;">
									<div class="post-left">
						
						<p style="text-align: center;"><?php echo $models['marka'];?></p>
						<p style="text-align: center;"><?php echo $models['model'];?></p>
				
					</div>
					<div style="float: right;">
<?php if ($company == '' || $post['reg_check']==1): ?>
							<?php  echo '<p>Kontakt telefon: ' . $users['telefon'];?>


							<?php endif ?>

					<?php if ($company != ''  && $post['reg_check']==2): ?>
								<?php echo '<p>Kontakt telefon: ' . $company['telefon'];?>

							<?php endif ?>
								<p>Oglas postavljen: <?php echo date("d.m.y H:i", strtotime($post["created_at"])-7); ?></p>

								
							</div>
							<p style="margin-top: 7px;    margin-left: 200px;" class="cena_p"><?php $cena = $post['cena'];
								if ($cena != "Dogovor") {
									$cena = $cena . "€";
								}
								echo $cena;

								?> </p>
							</div>
							
							</a>
							<form action="/user/user?my=true$page_id=<?php $i = $post['id'] . '>operation'; echo $i;?>" method="post">
							<div class="botom" style="margin-top: 7px">
								<button  name="delete" value="<?php echo $post['id'];?>" style="background-color: #e40000;
    border: 1px solid #e40000;" onclick="return confirm('Jeste li sigurni da želite da obrišete vaš oglas?\n*Ok--želim da obrišem oglas\n*Cancle--Ne želim da obrišem oglas')"><i class="far fa-trash-alt"></i> Obriši oglas</button>
						
								<?php if (strtotime($post["created_at"]) < strtotime('-24 hours')): ?>
								<button name="repost"  value="<?php echo $post['id'];?>" style="background-color: green;
    border: 1px solid green;" onclick="return confirm('Jeste li sigurni da želite da ponovo objavite vaš oglas?\n*Ok--Želim da ponovo objavim oglas\n*Cancle--Ne želim da ponovo objavim oglas\n**Ovu funkciju možete upotrebiti svakih 24h **')"><i class="fas fa-retweet"></i> Obnovi</button><?php endif ?>
   <?php if ($post['published'] == true): ?>
    	
    
								<button name="publish"  value="<?php echo $post['id'];?>" style="background-color: green;
    border: 1px solid green;" onclick="return confirm('Jeste li sigurni da želite da vaš oglash ne bude vidljiv za ostale na sajtu?\n*Ok--Želim da bude nevidljiv\n*Cancle--Ne želim da bude nevidljiv')"><i class="far fa-eye"></i>Javno</button>
    <?php endif ?>
     <?php if ($post['published'] == false): ?>
    	
    
								<button name="publish1"  value="<?php echo $post['id'];?>" style="background-color: red;
    border: 1px solid red;" onclick="return confirm('Jeste li sigurni da želite da vađ oglash bude vidljiv za ostale na sajtu?\n*Ok--Želim da bude vidljiv\n*Cancle--Ne želim da bude vidljiv')"><i class="far fa-eye-slash"></i>Privatno</button>
    <?php endif ?>
							</div>
						</form>
							</div>
							
			<?php endforeach ?>