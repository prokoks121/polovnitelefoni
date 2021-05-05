<style type="text/css">
	.cena_p_comp{
		background-color: rgb(15, 109, 208);
	}
</style>
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
    $company = $stm->fetchAll(PDO::FETCH_ASSOC);


                                              
                                              $link = $models['marka'] . "-" . $models['model'];
$link = SplitWrods($link);



?>
				<div class="post <?php if($post['reklamno'] == 1){echo "post_rek";} ?>" >
<a href="/single_post/<?php echo $link; ?>/<?php echo $post['id']; ?>">
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
									<div class="post-left <?php if($post['reklamno'] == 1){echo "info_rek";} ?>">
						
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
								<p>Oglas objavljen pre: <?php echo getPostOldDays(strtotime($post["created_at"])); ?></p>

								
							</div>
								<p style="margin-top: 7px;    margin-left: 200px;" class="cena_p <?php if($post['reklamno'] == 1){echo "cena_p_rek";}elseif($post['reg_check'] == 2){echo "cena_p_comp";} ?>"><?php $cena = $post['cena'];
								if ($cena != "Dogovor") {
									$cena = $cena . "€";
								}
								echo $cena;

								?> </p>
							</div>
						
							</a>
							</div>
			<?php endforeach ?>