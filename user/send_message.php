<?php require_once('../config.php') ?>
<?php require_once( ROOT_PATH . '/includes/public_functions.php') ?>
<?php require_once( ROOT_PATH . '/user/user-fuction.php') ?>


<?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
<style type="text/css">.content{border-left: 1px solid #008fce;}</style>

	<title>Prouke | PolovniTelefoni.net</title>
</head>
<body>
<?php 


if (!isset($_SESSION['user']['id'])) {
	header('location: /register');				
					exit(0);
}
if (!isset($_GET['user_id'])) {
	header('location: /404');				
					
}
if (!isset($_GET['post_id'])) {
	header('location: /404');				
					
}
global $conns;
$messages = getMessages();

$user_id = $_GET['user_id'];
$code_id = $_GET['post_id'];
$sesion_user = $_SESSION['user']['id'];



$stm = $conns->prepare("SELECT * FROM users WHERE id=? AND code_id=? LIMIT 1");
        $stm->execute([$user_id,$code_id]);

    $users = $stm->fetch(PDO::FETCH_ASSOC);







 ?>
		<?php include( ROOT_PATH . '/includes/navbar.php') ?>
<div class="div_77">



<div style="float: left;">
	<a href="/custom_user?code_id=<?php echo $users['code_id']; ?>&user_id=<?php echo $users['id']; ?>">
	<img style="float: left;width: 120px;    margin-right: 25px;" src="<?php echo '/static/images/' . $users['image']; ?>">
</a>
	<div style="float: right;">
	
	<p style="margin: 3px 0px;">Oglas kreirao: <b><a style="color: #007cff" href="/custom_user?code_id=<?php echo $users['code_id']; ?>&user_id=<?php echo $users['id']; ?>"><?php echo $users['ime'] . " " .  $users['prezime'] ; ?></a></b></p>
	
	<p style="margin: 3px 0px;">Grad/Opština: <b><?php echo $users['grad'];?></b></p>
					<p style="margin: 3px 0px;"> Član od: <b><?php echo date("F j. Y ", strtotime($users["created_at"])); ?></b></p> 
					 <?php if (isset($users['telefon2'])) { echo '<p style="margin: 3px 0px;">Kontakt telefon:</br> ' . $users['telefon'] . ' || ' . $users['telefon2'] . '</p>';} else {echo '<p style="margin: 3px 0px;">Kontakt telefon: ' . $users['telefon'];}?>
</div>
				</div>
<div id="msgs" class="div_78">
	<?php foreach ($messages as $msg): ?>
		<div class="msgs" style="float: right; margin: 5px;
    width: 976px;
    padding: 5px 10px;">
    	<div style="background-color: #14264e30;
    margin: 3px;
    padding: 5px;<?php if ($sesion_user == $msg['my_id']){echo "float: right;border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;";}else{echo "float: left;border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;";} ?>">
   <p  style="    max-width: 780px;
    margin: 5px;
    
    padding: 5px 10px;
   "><?php echo $msg['text']; ?><p style="<?php if ($sesion_user == $msg['my_id']){echo "float: right;";}else{echo "float: left;";} ?>"><?php echo date("m.j.Y H:i", strtotime($msg["created_at"])); ?></p></p></div></div>
	
		
	<?php endforeach ?>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script type="text/javascript">
	
$('#msgs').animate({
    scrollTop: $('#msgs').get(0).scrollHeight
}, 1000,"easeInOutQuart");
</script>

<form  method="post" enctype="multipart/form-data">
	
<textarea name="text" style="margin-top: 50px;width: 95%;min-height: 150px;border-radius: 15px;
    padding: 25px;"></textarea>
	<input class="button" type="submit" name="submit_message" value="Posalji" style="  margin-top: 50px;
    padding: 15px 37px;
    font-size: 18px;">
    </form>
</div>





	
		<!-- footer -->
		<?php include( ROOT_PATH . '/includes/footer.php') ?>
		<!-- // footer -->