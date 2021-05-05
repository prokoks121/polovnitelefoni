<?php require_once('../config.php');
 require_once( ROOT_PATH . '/includes/public_functions.php');
 require_once( ROOT_PATH . '/user/user-fuction.php');
$id = $_POST['options'];
$email = $_POST['user'];
?>
<?php if ($id == 1): ?>


	<?php $posts = getPostsbyUser();
	if (empty($posts) || !isset($posts)) {
		echo " <p style='margin: 30px auto;
    width: 371px;
    font-size: 30px;
    font-family: arial;' > Nema objavljenih oglasa </p><i style='    margin: 0px auto;
    width: 62px;
    
    color: #0078d7;
    display: table;
    font-size: 60px;' class='far fa-frown'></i>";
	}else{ ?>
		<div class='content'> <?php include(ROOT_PATH . '/user/post-user.php') ?></div>
		<style type="text/css">.paginate{margin-top: 60px;
    }.content {margin-top: -31px!important;}
</style>
  
	<?php } ?>
	
<?php endif ?>
<?php if ($id == 5): ?>
	
    <div class="div_35" >
	<form style="float: left;margin-left: 35px;" method="post">
	<div class="sifra">
	<fieldset>
	<legend >Promeni šifru</legend>
	<div style="     margin: 0px auto;   width: 351px;">
	<label class="opste-labell"><span>Novu šifru </span>
	<input class="opste-input" type="password" name="sifra" pattern=".{6,}" title="Six or more characters"></label>
	<label class="opste-labell"><span>Ponovite šifru</span>
    <input class="opste-input" type="password" name="sifra1" pattern=".{6,}" title="Six or more characters"></label>
    <label class="opste-labell"><span>Trenutnu šifru</span>
    <input class="opste-input" type="password" name="sifra2"></label>
    </div>
    <div>
    <button class="button" name="sacuvaj2" type="submit">Sačuvaj</button>
</div>
</fieldset>
</div>
	</form>
    <form class="form_1" method="post">
    <div class="sifra">
    <fieldset>
    <legend >Promeni Email</legend>
    <div style="     margin: 0px auto;   width: 290px;   ">
    <label  class="opste-labell"><span>Email </span>
        <input class="opste-input" type="email" name="email122" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="<?php echo $email?>">
   </label>
    </div>
    <div>
    <button style="margin-top: 20px;" class="button" name="sacuvaj13" type="submit">Sačuvaj</button>
</div>
</fieldset>
<p style="font-family: arial;
    font-size: 14px;
    color: #484343;">*Kod za potvrdu identifikacije će biti poslat na e-mail koji budete uneli</p>
</div>
    </form>
</div>
<?php endif ?>






<?php if ($id == 2): ?>

    <div class="div_32" >
          <a class="follow_id12 prviid" style="border-top-left-radius: 15px;" name="1">Korisnici koje pratim</a>
        <a class="follow_id12" style="border-top-right-radius: 15px;margin-left: -5px;" name="2">Oglasi koje pratim</a>
      
    </div>
<div id="follow_id2"></div>

<script type="text/javascript">
$(".prviid").addClass('follow_id121');
  var img = "<img class='loading-img-gif' src='/static/images/icons/loading.gif'/>";
    $('#follow_id2').html(img);
     $.ajax({
           type: "POST",
           url: "follow_id2.php",
           data: 'options=1',
           success: function(whatigot) {
               $('#follow_id2').html(whatigot);
           }
       });

$(".follow_id12").click(function(){
    if ($(".follow_id121").attr('name') != $(this).attr('name')) {
      var img = "<img class='loading-img-gif' src='/static/images/icons/loading.gif'/>";
    $('#follow_id2').html(img);
    $(".follow_id121").removeClass('follow_id121');
    $(this).addClass('follow_id121');

var id = $(this).attr('name');
$.ajax({
           type: "POST",
           url: "follow_id2.php",
           data: 'options=' + id ,
           success: function(whatigot) {
               $('#follow_id2').html(whatigot);
           }
       });
}

});

</script>




<?php endif ?>
<?php if ($id == 3): ?>
	<?php $messages = getMyMessages();
if (empty($messages) || !isset($messages)) {
		echo " <p style='margin: 30px auto;
    width: 329px;
    font-size: 30px;
    font-family: arial;' > Nema poruka </p><i style='    margin: 0px auto;
    width: 62px;
    
    color: #0078d7;
    display: table;
    font-size: 60px;' class='far fa-frown'></i>";
	}else{ ?>
		<?php include( ROOT_PATH . '/user/messages.php') ?>
			

	<?php } ?> 

<?php endif ?>

<?php if ($id == 7): ?>
<?php $posts = getCommentsUser();
if (empty($posts) || !isset($posts)) {
        echo " <p style='margin: 30px auto;
    width: 329px;
    font-size: 30px;
    font-family: arial;' > Nema komentara </p><i style='    margin: 0px auto;
    width: 62px;
    
    color: #0078d7;
    display: table;
    font-size: 60px;' class='far fa-frown'></i>";
    }else{ ?>
      <?php include(ROOT_PATH . '/includes/user_comments.php') ?>
        <style type="text/css">.paginate{margin-top: 60px;
    </style>
              
<?php } ?> 

<?php endif ?>

