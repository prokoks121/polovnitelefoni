<style type="text/css">
	.sidebar[0]{
display: none;
	}
</style>

<div id="LaDIV"></div>
<div id="sidebar123" style="    margin-top: 20px;">
	<?php
	if (isset($id_modela)) {
		$posts = getPublishedPostsSidebar($id_modela);
	}
	?>
	<?php foreach ($posts as $post): ?>
<?php 


	$id_telefona = $post['id_telefona'];
global $errors;


    $stm = $conns->prepare("SELECT photo,marka,model FROM phones WHERE id=?");
        $stm->execute([$id_telefona]);
        $models = $stm->fetch(PDO::FETCH_ASSOC);


$user_id = $post['user_id'];

  $stm = $conns->prepare("SELECT telefon,telefon2 FROM users WHERE id=?");
        $stm->execute([$user_id]);
        $users  = $stm->fetch(PDO::FETCH_ASSOC);




if ($post['starost'] != "Kao nov" AND $post['starost'] != "Potpuno nov") {
	$starost = "Polovan";

	
}else{$starost = $post['starost'];
}


if ($post['garancija'] == ""){
	$garancija = "Nema";
}else{
	$garancija ="Garancija: Da";
}


if ($post['mreza'] == 1) {
	$mreza = "Otključan na svim mrežama";
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
 
$link = $models['marka'] . "-" . $models['model'];
$link = SplitWrods($link);


?>
				<div class="sidebar">
					<a style="color: black;" href="/single_post/<?php echo $link; ?>/<?php echo $post['id']; ?>" >
					<div style="font-weight: 550;font-size: 20px; margin-top: 10px;width: 300px;">
						<p style="text-align: center;"><?php echo $models['marka'] . " " . $models['model'];?></p>
					</div>
					<div class="post-left" style="width: 100px !important;" >
					<img style="width: 100px;" src="<?php echo '/static/images/modeli/' . $models['photo']; ?>"  alt="">
					</div>
					<div class="sidebar_right">
						<p style="margin: 5px 0px;"><?php echo $mreza ?></p>
						<p style="margin: 5px 0px;"><?php echo $garancija ?></p>
						<p style="margin: 5px 0px;">Stanje uređaja: <?php echo  $starost?></p>
						<p>Objavljeno: <?php echo date("d.m.y H:i", strtotime($post["created_at"])); ?></p>
<p class="sidebar_cena"> <?php $cena = $post['cena'];
								if ($cena != "Dogovor") {
									$cena = $cena . "€";
								}
								echo $cena;

								?> </p>
				</div></a></div>

			<?php endforeach ?>
			<script type="text/javascript">
		$(document).ready(function(){
var height = parseFloat($(window).height());
var num = Math.floor(height / 187) * 187;
$('#sidebar123').css({"height":num,"overflow":"hidden"});
$(".sidebar").eq(0).css({"display":"none"});
	        $(function() {

    var $sidebar   = $("#sidebar123"),
        $window    = $(window),
        offset     = $sidebar.offset(),
        topPadding = 30;
  	

    $window.scroll(function() {
    	 var $side_ofset = $("#offest"), 
    offest1 = $side_ofset.offset();
        if ($window.scrollTop() > offset.top) {
        	if ($window.scrollTop() < (offest1.top - num - 45)) {
            $sidebar.stop().animate({
                marginTop: $window.scrollTop() - offset.top + topPadding
            });
        }
        } else {
            $sidebar.stop().animate({
                marginTop: 0
            });
        }
    });
       });
});
</script>
</div>
