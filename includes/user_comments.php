<?php $user_get_3 = GetSessionUserPublic(); 

     ?>
<style type="text/css">
    .comm_funt{
color: #14264e;
    font-family: 'Source Sans Pro',sans-serif;
    font-size: 15px;
    font-weight: bold;
   cursor: pointer;
    padding: 5px 7px 10px 7px;
   transition-duration: 0.2s;
       border: none;
    background: white;
    }
   .comm_funt:hover{
    color: #d1414b;
      border: 2px solid #ff00009c;
    box-shadow: 0px 3px 7px 0px #d1414b;
    border-top: none;
    border-radius: 4px;
    padding-bottom: 5px;
    transition-duration: 0.2s;
   }
</style>
<script type="text/javascript">
       $(document).ready(function(){

      $(".img-logo_2").each(function(){
 var height = $(this).height();
                  var width = $(this).width();
                  if (height > width) {
                 var left = ((height*60)/width - 60)/2;
                        left = "-=" + left;
                        $(this).css({"max-width":"60px","top":left,"left":"0"});
                    }else if(height < width){
              var left = ((width*60)/height - 60)/2;
                        left = "-=" + left;
                        $(this).css({"max-height":"60px","left":left,"top":"0"});

                                 }else{
                                              $(this).css({"max-height":"60px","left":"0","top":"0"});

                      
                    }
              });      
      });
</script>
<?php 



    $stm = $conns->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stm->execute([$user_id]);



if ($stm->rowCount() == 1) {
    $exist = "true";
}else{
    $exist = "false";
} ?>
<div style="font-family: arial;">

<?php if ($exist == "true"): ?>
<?php if (isset($_SESSION['user']['id'])){ ?>
        
    

	<form class="form_2" method="post">
    <div class="div_72" >
<div style="      width: 25px;
    top: 50%;
    display: table-cell;
    vertical-align: middle;
    height: 25px;">

    	<div style="    margin-left: -5px;
    
    margin-top: -5px;">
    <?php if (isset($_SESSION['user']['id'])) {
  $img = $user_get_3['image'];
}else{
    $img = "defaultuser.jpg";
} ?>
<img class="img-logo_2" src="/static/images/<?php echo $img ?>" no-repeat center center>
</div>

</div>
	</div>
		<textarea class="textarea_3" name="text"></textarea>
    <div class="smile-up"><i id="fa-smile"  class="far fa-smile"></i></div>
        <div class="smile-down"><i id="fa-frown"  class="far fa-frown"></i></div>
<input type="text" name="smile" style="display: none;visibility: hidden;" id="smile_input">
		<button style="    float: right;
    margin-top: 2px;
    margin-right: 11px;
    width: 128px;" class="btn" name="com_submit">Objavi</button>
	</form>
        <?php }else{ ?>

    <div method="post" style="   min-height: 132px;
    width: 670px;
    margin: auto;
    margin-top: 45px;">
    <div class="image-upload" style="width: 40px;
    height: 40px;
    float: left;
    margin-top: 0px;
    margin-left: -42px;
    margin-right: 7px;
    background-color: white;box-shadow: -2px 2px 8px 1px #14264e;">
<div style="      width: 25px;
    top: 50%;
    display: table-cell;
    vertical-align: middle;
    height: 25px;">

        <div style="    margin-left: -5px;
    
    margin-top: -5px;">
    <?php if (isset($_SESSION['user']['id'])) {
  $img = $user_get_3['image'];
}else{
    $img = "defaultuser.jpg";
} ?>
<img class="img-logo_2"  src="/static/images/<?php echo $img ?>" no-repeat center center >
</div>

</div>
    </div>
        <textarea style="    float: left;
    min-height: 60px;
    border-radius: 5px;
    padding: 7px;
    width: 482px;" name="text"></textarea>
    <div class="smile-up"><i id="fa-smile"  class="far fa-smile"></i></div>
        <div class="smile-down"><i id="fa-frown"  class="far fa-frown"></i></div>
<input type="text" name="smile" style="display: none;visibility: hidden;" id="smile_input">
        <button style="    float: right;
    margin-top: 2px;
    margin-right: 11px;
    width: 128px;" class="btn" name="com_submit">Objavi</button>
    <div class="div_73"></div>
    </div>
    <?php } ?>
    <?php endif ?>
		<div style="    padding-bottom: 20px;padding-top: 20px;">
	<?php foreach ($posts as $com): ?>
		<?php $user_id = $com['user_id'];

    $stm = $conns->prepare("SELECT * FROM users WHERE id=?");
        $stm->execute([$user_id]);
        $user = $stm->fetch(PDO::FETCH_ASSOC);

 ?>
		<div class="div_74">
			<div class="div_75">
<a href="../custom_user?code_id=<?php echo $user['code_id']; ?>&user_id=<?php echo $user['id']; ?>">
<div style="      width: 25px;
    top: 50%;
    display: table-cell;
    vertical-align: middle;
    height: 25px;">

    	<div style="    margin-left: -5px;
    
    margin-top: -5px;">
<img class="img-logo_2"  src="/static/images/<?php echo($user['image']) ?>" no-repeat center center >
</div>

</div>
</a>
	</div>	<div>
		<a href="../custom_user?code_id=<?php echo $user['code_id']; ?>&user_id=<?php echo $user['id']; ?>">
			<p style="color: #007cff;float: left;margin-left: 10px;"><?php echo $user['ime'] ." ". $user['prezime']; if ($com['smile'] == '1') {
               echo ' <i  class="far fa-smile" style="font-size:19px;margin-top:0px;"></i>';
            }else{echo '<i  class="far fa-frown" style="font-size:19px;margin-top:0px;"></i>';} ?></p>
		</a>
				<p style="float: right;"><?php echo date("d.m.y H:i", strtotime($com["created_at"])); ?></p>
                 <div style="float: right;
    margin-right: 20px;
    margin-top: -7px;
    display: flex;"><a class="comm_funt" target="_blank" href="/report?comm_id=<?php echo $com['id'] ?>" >Prijavi</a><?php

if (isset($_SESSION['user']['id'])) {
  $user_id1 = $_SESSION['user']['id'];
}else{
    $user_id1 = false;
}

     if ($com['user_id'] == $user_id1): ?>
    <form method="post">
          <button value="<?php echo $com['id']?>" onclick="return confirm('Jeste li sigurni da želite da obrišete komentar?\n*Ok--Želim da izbrišem komentar\n*Cancle--Ne želim da izbrišem komentar')" class="comm_funt" type="submit" name="comm_delete" >Obrisi</button>
    </form>
      
    <?php endif ?>
   
      
   </div>

			</div>
			<p class="p_31"><?php echo $com['text']?></p>
										

		</div>
	<?php endforeach ?>
	</div>
</div>
<script type="text/javascript">
	$('.smile-up').on('click',function() {
		$(this).css({"background-color": "green", "border-radius":"5px"});
		$('.smile-down').css({"background-color": "white","border-radius":"0px"});
		$('#fa-smile').css({"color":" white"});
		$('#fa-frown').css({"color":" red"});
		$('#smile_input').val("1");

	});

	$('.smile-down').on('click',function() {
		$(this).css({"background-color": "red","border-radius":"5px"});
		$('.smile-up').css({"background-color": "white","border-radius":"0px"});
		$('#fa-smile').css({"color":" green"});
		$('#fa-frown').css({"color":" white"});
		$('#smile_input').val("2");

	});
</script>