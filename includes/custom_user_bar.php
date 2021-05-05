<?php
require_once('../config.php');
 require_once( ROOT_PATH . '/includes/public_functions.php');
 require_once( ROOT_PATH . '/user/user-fuction.php');

$id = $_POST['options'];
$user_id = $_POST['user_id'];

 if ($id == 2): ?>


	<?php $posts = getPostsbyCustomUser($user_id);
	if (empty($posts) || !isset($posts)) {
		echo " <p style='margin: 30px auto;
    width: 371px;
    font-size: 30px;
    font-family: arial;' > Korisnik nema aktivnih oglasa. </p><i style='    margin: 0px auto;
    width: 62px;
    
    color: #0078d7;
    display: table;
    font-size: 60px;' class='far fa-frown'></i>";
	}else{ ?>
		<div class="div_76"> <?php include(ROOT_PATH . '/includes/posts.php') ?></div>
		<style type="text/css">.paginate{margin-top: 60px;
    }</style>
    <?php }$var="1"; ?>

	
<?php endif ?>
<?php if ($id == 1): ?>


	<?php $posts = getComments($user_id); ?>
	<div style="font-family: arial;
    background-color: white;
    border-radius: 15px;
    border-top-left-radius: 0px;
    padding: 10px 0px;
    margin-top: -9px;">
		 <?php include(ROOT_PATH . '/includes/user_comments.php') ?>
    </div>
		<style type="text/css">.paginate{margin-top: 60px;
    }</style>
   
	<?php $var="2"; ?>
	
<?php endif ?>