<?php foreach ($users as $userer): ?>
	

<?php 
$userers=$userer['id'];


    $stm = $conns->prepare("SELECT * FROM posts WHERE delete_check='false' AND published=true AND user_id=?");
    $stm->execute([$userers]);
    $posts = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="fol_user">
	<div class="div_34" >
<div class="image-upload" style="width: 25px;height: 25px;margin-left: 189px;float: left;margin-top: -17px;">
<a href="/custom_user?code_id=<?php echo $userer['code_id']; ?>&user_id=<?php echo $userer['id']; ?>">
<div style="      width: 25px;
    top: 50%;
    display: table-cell;
    vertical-align: middle;
    height: 25px;">

    	<div style="    margin-left: -5px;
    
    margin-top: -5px;">
<img class="img-logo" style="width: 35px;height: 35px;" src="/static/images/<?php echo($userer['image']) ?>" no-repeat center center max-height="35" max-width="35">
</div>

</div>
</a>
	</div>	
<div class="fol_usered" >

    <i class="fas fa-sort-down" ></i>
	 
	<div class="div_33">
<p style="float: left;margin-right: 5px; color: #007cff;
   "><?php echo $userer['ime']; ?></p>
<p style="float: left;margin-right: 5px;
   color: #007cff;"><?php echo $userer['prezime']; ?></p>

   

</div>
	

</div>

</div>








<div class="fol_posts" style="display: none;" >

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



        $stm = $conns->prepare("SELECT * FROM company WHERE user_id=? LIMIT 1");
    $stm->execute([$user_id]);
     $company = $stm->fetch(PDO::FETCH_ASSOC);
?>
	
				<div class="post" >
					<a href="/single_post?id=<?php echo $post['id']; ?>">
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

						<p style="font-size: 15px;margin: 0px"><?php echo mb_strimwidth($post['body'], 0, 189, '...');?></p>
						

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

								<p>Oglas postavljen: <?php echo date("d.m.y H:i", strtotime($post["created_at"])); ?></p>
							</div>

	<p style="margin-top: 7px;    margin-left: 200px;" class="cena_p"><?php $cena = $post['cena'];
								if ($cena != "Dogovor") {
									$cena = $cena . "€";
								}
								echo $cena;

								?> </p>
								
								</div>
							</a>
							</div>
							<?php endforeach ?>
						</div>
</div>


<?php endforeach ?>

<script type="text/javascript">
	$(".fol_user").on('click',function(){
		
		$(this).find($(".fol_posts")).slideToggle( "slow" );
	
	});	
</script>