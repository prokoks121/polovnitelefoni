
<div id="refresh" style=" margin-top: 20px;   
    padding: 20px 2.5%;
    width: 95%;
    ">
	<?php foreach ($messages as $message): ?>
	
    <?php 

global $conns;

$my_id = $_SESSION['user']['id'];
$messages_id = $message['message_id'];


    $stm = $conns->prepare("SELECT * FROM messages WHERE message_id=? ORDER BY created_at DESC LIMIT 1");
    $stm->execute([$messages_id]);
    $mess = $stm->fetch(PDO::FETCH_BOTH);


if ($mess['my_id'] == $my_id) {
	$user_id = $mess['user_id'];
}else{
	$user_id = $mess['my_id'];
}

    $stm = $conns->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
    $stm->execute([$user_id]);
    $user = $stm->fetch(PDO::FETCH_BOTH);

   ?>


   <div class="msg" >
   
      <div class="mesg_time" >
     <a target="_blank" style="    color: black;" href="/custom_user?code_id=<?php echo $user['code_id']; ?>&user_id=<?php echo $user['id']; ?>">
   	<p style="color: #007cff;height: 20px;
    overflow: hidden;"><?php echo mb_strimwidth( $user['ime'], 0, 16,'') . " " . mb_strimwidth( $user['prezime'], 0, 13,''); ?></p><p ><?php echo date("d.m.y H:i", strtotime($mess["created_at"])); ?></p>
   </a>
     <div class="image-upload_1">
    

<div style="      width: 25px;
    top: 50%;
    display: table-cell;
    vertical-align: middle;
    height: 25px;">

      <div style="    margin-left: -10px;
    
    margin-top: -10px;">
<img class="img-logo" style="width: 45px;height: 45px;" src="/static/images/<?php echo($user['image']) ?>" no-repeat center center max-height="40" max-width="40">
</div>

</div>

  </div> 
  </a>
   </div>
    <a target="_blank" style="    color: black;" href="/user/send_message?post_id=<?php echo $user['code_id']; ?>&user_id=<?php echo $user['id']; ?>">
   <div class="text_mess" >
 <p style="background-color: <?php if ($mess['checked'] == 0 && $mess['my_id'] != $my_id) {
   echo "#d1414bb8;";
 }else{ echo "#71717133;";} ?>
    padding: 5px 10px;border-radius: 60px;"><?php echo mb_strimwidth( $mess['text'], 0, 65, '...') ?></p> 
  </div>
</a>
    </div>
	<?php endforeach ?>





</div>
