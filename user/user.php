<?php require_once('../config.php') ?>
<?php if (!isset($_SESSION['user']['id'])) {
	header('location: /login.php');				
					exit(0);
}






   $user_id = $_SESSION['user']['id'];
    $stm = $conns->prepare("SELECT * FROM posts WHERE user_id=? AND published=true");
    $stm->execute([$user_id]);
   $num_activ = $stm->rowCount();

      $stm = $conns->prepare("SELECT * FROM follow WHERE id_post=? AND folowed_user=1");
    $stm->execute([$user_id]);
   $num_folow = $stm->rowCount();

  $stm = $conns->prepare("SELECT * FROM comments WHERE to_user=? AND smile=1");
    $stm->execute([$user_id]);
   $num_com_1 = $stm->rowCount();
   $stm = $conns->prepare("SELECT * FROM comments WHERE to_user=? AND smile=2");
    $stm->execute([$user_id]);
   $num_com_2 = $stm->rowCount();







 ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>

<?php include( ROOT_PATH . '/includes/head_section.php') ?>
<style type="text/css">
    @media only screen and (min-width: 1024px) {
            .content {
           
width: 1004px!important;
     

   
}
}
      .content {
            box-shadow: none!important;
    background-color: transparent!important;
padding-left: 15px!important;
     border: none !important; 
   margin: 0px!important;

   
}
.vip_div{
    cursor: pointer;
    position: absolute;
    font-family: Arial;
    
    margin-top: -37px;
    margin-left: 117px;
    background-color: #d1414b;
    border-radius: 5px;
    transition-duration: 0.2s;
}
.vip_div:hover{
    padding: 3px 5px;
    transition-duration: 0.2s;
    margin-left: 112px;
     margin-top: -40px;

}
.vip_div:hover .fa-crown{
    transition-duration: 0.2s;
    margin-top: -32px!important;
    font-size: 24px;
    margin-left: 42px!important;
}
.div-bar{
    margin-left: 0px;
    padding-right: 0px;
    padding-left: 0px;
    padding-bottom: 0px;
    border-bottom: unset;
}

</style>

	<title>Korisnički panel | PolovniTelefoni.net</title>
</head>
<body>
		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

	<div class="container">
</div>
<div style="width: 60%; margin: 0px auto;">
					<?php include(ROOT_PATH . '/includes/errors.php') ?>
				</div>

	  <?php $user_get_5 = GetSessionUserPublic(); 
     ?>

<div class="podesavanja">
    <div class="opste_1">
	<p class="opstes">Opšta podešavanja profila</p>
    <div class="opste-img">

<h2 class="h2_2">Korisnička slika</h2>
    <div class="image-upload image-upload_2">

<form  style="        width: 150px;
    top: 50%;
    display: table-cell;
    vertical-align: middle;
    height: 150px;"  method="post" enctype="multipart/form-data">

    <label for="file-input">
    	<div style="cursor: pointer;">
      
<img class="img-logo_1" id="resize_1" src="/static/images/<?php echo($user_get_5['image']) ?>" no-repeat center center >
      <script type="text/javascript">
                 var height = $("#resize_1").height();
                  var width = $("#resize_1").width();
                  if (height > width) {
                 var left = ((height*170)/width - 170)/2;
                        left = "-=" + left;
                        $("#resize_1").css({"max-width":"170px","top":left,"left":"0"});
                    }else if(height < width){

  var left = ((width*170)/height - 170)/2;
                        left = "-=" + left;
                        $("#resize_1").css({"max-height":"170px","left":left,"top":"0"});

  }else{
                                              $("#resize_1").css({"max-height":"170px","left":"0","top":"0"});

                      
                    }
               
            </script>
</div>
</label>

	<input style=" display: none;" id="file-input" type="file" name="logo" onchange="this.form.submit()" />
</form>
	</div>	

    </div>
<p class="p-img" style="font-family: arial;
    font-size: 12px;
    color: #484343;">*Kliknite na sliku ako želite da je promenite.</p>



<form method="post">
	<div class="opste">
		
    	
    		<fieldset>
			 <legend >Opšti podaci</legend>

      <?php if ($user_get_5['confirmation'] != "1"){ 
    echo '<p style="    white-space: nowrap;
    width: 340px;
    overflow: hidden;
    font-family: Source Sans Pro, sans-serif;
    padding: 8px 13px;
    color: yellow;
    position: absolute;
    font-size: 15px;
    background-color: #14264e;margin-top: -49px;border-radius: 12px;"><i style="font-size: 18px;" class="fas fa-exclamation-triangle"></i>              Verifikujte vas nalog '. $user_get_5['email'] .'!!!</p><form method="post"><button name="submit12" style="    position: absolute;
    cursor: pointer;
    -webkit-appearance: none;
    background: #14264e;
    border: none;
    font-weight: bold;
    font-family: Source Sans Pro,sans-serif;
    color: white;
  
    border-radius: 2px;
    margin-top: -49px;
    margin-left: 400px;
    padding: 9px 10px;border-radius: 13px;">Posalji ponovo</button></form>';
 } ?>
 <div class="vip_div" style="display: none;"><p style="  font-size: 19px;
    padding: 5px;
    color: white;"><i style="transition-duration: 0.2s;position: absolute;
    margin-left: 45px;
    margin-top: -18px;
    color: #c1c145;" class="fas fa-crown"></i> Kupi VIP nalog</span></p></div>
             <p class="p_12" ></p>
		<div class="podacii">
    <label class="opste-label" ><span>Korisničko ime</span>
<input class="opste-input" type="text" value="<?php echo($user_get_5['username']) ?>" disabled>
</label>

<label class="opste-label"><span>Ime</span>
<input class="opste-input " type="text" name="ime" value="<?php echo($user_get_5['ime']) ?>" pattern="[a-zA-Z]{1,10}" title="Nisu dozvoljeni brojevi i karakteri kao sto su: #,$,@"></label>
<label class="opste-label"><span>Prezime</span>
<input class="opste-input" type="text" name="prezime" value="<?php echo($user_get_5['prezime']) ?>" pattern="[a-zA-Z]{1,10}" title="Nisu dozvoljeni brojevi i karakteri kao sto su: #,$,@"></label>
<label class="opste-label"><span>Telefon</span>
<input class="opste-input" type="number"name="telefon" value="<?php echo($user_get_5['telefon']) ?>" pattern="^(?:0|\(?\+381\)?\s?|00381\s?)[1-79](?:[\.\-\s]?\d\d){4}$" title="Niste uneli btoj telefona"></label>
</div>
<div class="podaci2">
    <div class="email_change12">
    <a href="/user/user?pass=true"  class="email_change">Promeni email</a>
<label style="padding-right: 13px;" class="opste-label" ><span>Email</span>
<input class="opste-input"   type="text" name="mail123"  value="<?php echo($user_get_5['email']) ?>" disabled>
</label>
  </div>


<label class="opste-label"><span>Adresa</span>
<input class="opste-input" type="text" name="adresa" value="<?php echo($user_get_5['adresa']) ?>" pattern="[a-zA-Z0-9_ ]{3,20}" title="Nisu dozvoljeni karakteri kao sto su: #,$,@"></label>
<label class="opste-label"><span>Grad</span>
<input class="opste-input" type="text" name="grad" value="<?php echo($user_get_5['grad']) ?>" pattern="[a-zA-Z0-9_ ]{1,15}" title="Nisu dozvoljeni karakteri kao sto su: #,$,@"></label>
<label class="opste-label"><span>Telefon 2</span>
<input class="opste-input" type="number" name="telefon2" value="<?php echo($user_get_5['telefon2']) ?>" pattern="^(?:0|\(?\+381\)?\s?|00381\s?)[1-79](?:[\.\-\s]?\d\d){4}$" title="Niste uneli btoj telefona"></label>
</div>
<div>
<button class="button" name="sacuvaj" type="submit">Sačuvaj</button>
</div>

</fieldset>
</div>
<?php if ($user_get_5['confirmation'] != "1"): ?>
    

<script type="text/javascript">
        $( ".opste-input" ).prop( "disabled", true );

</script>
<?php endif ?>
</form>
</div>
<div style="padding-bottom: 17px;">



<div class="div_30">
        <div class="div_31">
            <p class="p_13"><i style="    color: #d1414b;" class="fas fa-archive"></i> Ukupno oglasa: <?php echo $user_get_5['num_post']; ?></p>
            <p class="p_13"><i style="    color: #d1414b;" class="far fa-file-alt"></i> Aktivnih oglas: <?php echo $num_activ; ?></p>
            <p class="p_13"><i style="    color: #d1414b;" class="fas fa-users"></i> Pratilaca: <?php echo $num_folow; ?></p>
            <p class="p_13"><i style="    color: #d1414b;" class="far fa-comments"></i> Pozitivni komentari: <?php echo $num_com_1;?></p>
            <p class="p_13"><i style="    color: #d1414b;" class="fas fa-comments"></i> Negativni komentari: <?php echo $num_com_2;?></p>


        </div>
    </div>





<div class="div-bar" >
	<a class="bar" id="my" name="1"  style="border-top-left-radius: 13px;">Moji oglasi</a>
	<a class="bar" id="follow" name="2" >Oglasi koje pratim</a>
	<a class="bar" id="message" name="3" >Poruke</a>
	<a class="bar" id="pass" name="5" >Promeni lozinku & Email</a>
 

	<a class="bar" id="comm" name="7" style="border-top-right-radius: 13px;">Komentari</a>
</div>
<?php

if (isset($_GET['my'])) {
    $var="1";

}else if(isset($_GET['pass'])){
    $var="5"; 

}else if(isset($_GET['follow'])){
    $var="2";

}else if(isset($_GET['message'])){
    $var="3";

}else if(isset($_GET['comments'])){
    $var="7";

}else{
       $var="1";
}




 ?>









<div class="div_s">



</div>
<script type="text/javascript">
    var heart = <?php echo $var; ?>;
    var email = "<?php echo $user_get_5['email'];?>";
    var img = "<img class='loading-img-gif' src='/static/images/icons/loading.gif'/>";
    $('.div_s').html(img);
    $("[name='<?php echo $var; ?>']").addClass("bar-select");
     $.ajax({
           type: "POST",
           url: "user-adc.php",
           data: "options="+heart+"&user="+ email,
           success: function(whatigot) {
               $('.div_s').html(whatigot);
           }
       });

$(".bar").click(function(){
    if ($(".bar-select").attr('name') != $(this).attr('name')) {
    var img = "<img class='loading-img-gif' src='/static/images/icons/loading.gif'/>";
    $('.div_s').html(img);
$(".bar-select").removeClass("bar-select");
var id = $(this).attr('name');
$(this).addClass("bar-select");
$.ajax({
           type: "POST",
           url: "user-adc.php",
           data: "options="+id+"&user="+ email,
           success: function(whatigot) {
               $('.div_s').html(whatigot);
           }
       });

}
});

</script>



</div>
<script type="text/javascript">
	$(document).ready(function(){
        $('.vip_div').remove();  
        });       
</script>
</div>

		<?php include( ROOT_PATH . '/includes/footer.php') ?>

