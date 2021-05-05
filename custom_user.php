<?php require_once('config.php');


 require_once( ROOT_PATH . '/includes/public_functions.php');
   
 require_once( ROOT_PATH . '/user/user-fuction.php');
   if (!isset($_SESSION['user']['id'])) {
    include( ROOT_PATH . '/includes/login_bar.php');

} 

 $user=getSingleUser();
 if ($user == "" || !isset($user) || empty($user)) {
   header("location: /404");
 }
if (isset($_GET['user_id']) && isset($_GET['code_id'])) {
   $user_id= $_GET['user_id'];
$code_id = $_GET['code_id'];
}

  $stm = $conns->prepare("SELECT * FROM posts WHERE user_id=? AND published=true");
    $stm->execute([$user_id]);
$num_activ =  $stm->rowCount();
  $stm = $conns->prepare("SELECT * FROM follow WHERE id_user=?");
    $stm->execute([$user_id]);
$num_folow =  $stm->rowCount();

if (isset($_SESSION['user']['id'])) {
    $fol = $_SESSION['user']['id'];

      $stm = $conns->prepare("SELECT * FROM follow WHERE folowed_user=?  AND id_user=?");
    $stm->execute([$fol,$user_id]);
 $follow =  $stm->rowCount();
 }
 $stm = $conns->prepare("SELECT * FROM comments WHERE to_user=? AND smile=1");
    $stm->execute([$user_id]);
 $num_com_1 =  $stm->rowCount();
  $stm = $conns->prepare("SELECT * FROM comments WHERE to_user=? AND smile=2");
    $stm->execute([$user_id]);
$num_com_2 =  $stm->rowCount();
if (isset($_SESSION['user']['id'])) {

if ($_SESSION['user']['id'] == $user_id) {
header("location: /user/user");
}}









?>

<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<style type="text/css">
     .report_div{
              position: absolute;
    
    margin-left: 250px;
    margin-top: 215px;
    border-radius: 30px;
    overflow: hidden;
    float: right;
    margin-right: 20px;
    background-color: #ec202e;
    padding: 10px;
    font-weight: 600;
    transition-duration: 0.2s;
    width: 18px;
    height: 18px;
   }
   .report_a{
     color: white;
    font-size: 16px;
    width: 151px;
    height: 18px;
    position: absolute;
   }
   #report{
      margin-left: 9px;
   }
.report_div:hover{
    margin-left:500px;
}  
.report_div:hover{
    margin-left:115px;
     width: 151px;
}  
.div-bar{
           padding-right: 617px;
    margin-left: 0px;
    padding-left: 0px;
}
#follow{
  border-top-left-radius: 15px;
}
#my{
  border-top-right-radius: 15px;
}
</style>

	<title>PolovniTelefoni.net | <?php echo$user['ime'] ." " .$user['prezime'] ?></title>
</head>
<body>

		<?php include( ROOT_PATH . '/includes/navbar.php') ?>

<div class="container">

		<div class="content" style="min-height: 800px;    padding-bottom: 26px;">
			<div style="    padding-top: 50px;">
        <div style="    background-color: white;
    border-radius: 15px;
    display: flow-root;">
			    <div class="div_66">

<div style="        width: 150px;
    top: 50%;
    display: table-cell;
    vertical-align: middle;
    height: 150px;"  method="post" enctype="multipart/form-data">

    <label for="file-input">
    	<div>
<img class="img-logo_1" id="resize_1" src="/static/images/<?php echo($user['image']) ?>" no-repeat center center >
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

</div>

	</div>
	 <div class="div_68"><?php if (isset($_SESSION['user']['id'])): ?>
	 <form method="post"><button class="btn_1" name="zaprati" >
	 	
	 <?php if ($follow == 0): ?>

	 	<i class="far fa-star"></i> Prati korisnika</button>
	 <?php endif ?>

	 <?php if ($follow != 0): ?>
	 	<i class="fas fa-star"></i> Otprati korisnika</button>
	 <?php endif ?>

	

	</form>

	<?php endif ?>

	<?php if (!isset($_SESSION['user']['id'])): ?>
	 	<button class="btn_1" name="zaprati" > 	<i class="far fa-star"></i> Prati korisnika</button>
	 <?php endif ?>
     <?php if (isset($_SESSION['user']['id'])): ?>
	<a class="btn_1" style="
    margin-left: 195px;
    font-size: 13px;
    width: 126px;" href="/user/send_message?post_id=<?php echo $user['code_id'] ?>&user_id=<?php echo $user['id'] ?>"> 	<i class="fas fa-envelope"></i> Pošalji poruku</a>
         <?php else: ?>
            <a class="btn_1" style="
    margin-left: 195px;
    font-size: 13px;
 
    width: 126px;cursor: pointer;" ><i class="fas fa-envelope"></i> Pošalji poruku</a>
             <?php endif ?>
	 </div>	 <div class="div_67"><legend style="    width: 255px;" >Opšti podaci korisnika</legend>

           
           
		<div class="podacii">
 

<label class="opste-label"><span>Ime</span>
<input class="opste-input " type="text" value="<?php echo($user['ime']) ?>" disabled></label>
<label class="opste-label"><span>Prezime</span>
<input class="opste-input" type="text" value="<?php echo($user['prezime']) ?>" disabled></label>
<label class="opste-label"><span>Telefon</span>
<input class="opste-input" type="number"value="<?php echo($user['telefon']) ?>" disabled></label>
</div>
<div class="podaci2">
<label class="opste-label"><span>Adresa</span>
<input class="opste-input" type="text" value="Privatno" disabled></label>
<label class="opste-label"><span>Grad</span>
<input class="opste-input" type="text"value="<?php echo($user['grad']) ?>"disabled></label>
<label class="opste-label"><span>Telefon 2</span>
<input class="opste-input" type="number" value="<?php echo($user['telefon2']) ?>" disabled></label>
<label class="opste-label"><span>Član od</span>
<input class="opste-input" type="text" value="<?php echo date("d M.Y", strtotime($user["created_at"])); ?>" disabled></label>

</div>
 <div class="report_div div_71">
                  <a target="_blank" href="/report?user_id=<?php echo $_GET['user_id']; ?>" class="report_a"><i class="fas fa-exclamation-triangle"></i><span id="report">Prijavi korisnika</span></a>
               </div>
<div>

</div>
 

</fieldset>
</div>
</div>
<div class="div_69">
		<div class="div_70">
			<p class="p_30"><i style="    color: #d1414b;" class="fas fa-archive"></i> Ukupno oglasa: <?php echo $user['num_post']; ?></p>
			<p class="p_30"><i style="    color: #d1414b;" class="far fa-file-alt"></i> Aktivnih oglas: <?php echo $num_activ; ?></p>
			<p class="p_30"><i style="    color: #d1414b;" class="fas fa-users"></i> Pratilaca: <?php echo $num_folow; ?></p>
			<p class="p_30"><i style="    color: #d1414b;" class="far fa-comments"></i> Pozitivni komentari: <?php echo $num_com_1;?></p>
			<p class="p_30"><i style="    color: #d1414b;" class="fas fa-comments"></i> Negativni komentari: <?php echo $num_com_2;?></p>


		</div>
    </div>
			</div>
<div >
<div class="div-bar" style="margin-top: 50px;">
    <a class="bar" name="1" style="border-top-left-radius: 15px;">Komentari</a>
	<a class="bar" name="2" style="border-top-right-radius: 15px;">Svi oglasi</a>
	
	
</div>

<script type="text/javascript">
  var user_id = <?php echo $_GET['user_id']; ?>;
    var img = "<img class='loading-img-gif' src='/static/images/icons/loading.gif'/>";
    $('#div_inc').html(img);
    $("[name='1']").addClass("bar-select");
     $.ajax({
           type: "POST",
           url: "/includes/custom_user_bar.php",
           data: "options="+ 1 +"&user_id="+ user_id,
           success: function(whatigot) {
               $('#div_inc').html(whatigot);
           }
       });

$(".bar").click(function(){
  if ($(".bar-select").attr('name') != $(this).attr('name')) {
    var img = "<img class='loading-img-gif' src='/static/images/icons/loading.gif'/>";
    $('#div_inc').html(img);
$(".bar-select").removeClass("bar-select");
var id = $(this).attr('name');
$(this).addClass("bar-select");
$.ajax({
           type: "POST",
           url: "/includes/custom_user_bar.php",
           data: "options="+ id +"&user_id="+ user_id,
           success: function(whatigot) {
               $('#div_inc').html(whatigot);
           }
       });
}
});

</script>

<div id="div_inc">
  
</div>

</div>


		</div>
    
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
	