<?php require_once('../config.php');
 require_once( ROOT_PATH . '/includes/public_functions.php');
 require_once( ROOT_PATH . '/user/user-fuction.php');
$id = $_POST['options'];
?>

<?php if ($id == 1): ?>
    

	<?php $users =getFollowUsers();
	if (empty($users) || !isset($users)) {
		echo " <p style='margin: 30px auto;
    width: 329px;
    font-size: 30px;
    font-family: arial;' > Ne pratite nijedan oglas </p><i style='    margin: 0px auto;
    width: 62px;
    
    color: #0078d7;
    display: table;
    font-size: 60px;' class='far fa-frown'></i>";
	}else{ ?>
		<div class='content'> <?php include(ROOT_PATH . '/user/follow_user.php')?></div>
            <?php } ?>
<?php endif ?>
<?php if ($id == 2): ?>

    <?php $posts = getFollowPost();
  if (empty($posts) || !isset($posts)) {
        echo " <p style='margin: 30px auto;
    width: 329px;
    font-size: 30px;
    font-family: arial;' > Ne pratite nijedan oglas </p><i style='    margin: 0px auto;
    width: 62px;
    
    color: #0078d7;
    display: table;
    font-size: 60px;' class='far fa-frown'></i>";
    }else{ ?>
        <div class='content'> <?php include(ROOT_PATH . '/includes/posts.php')?></div>

      
 <?php } ?>

<?php endif  ?>
