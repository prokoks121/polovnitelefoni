
<div class="navbar"><div class="navbarr">
	<div class="logo_div">
		<a href="/index"><img style="    position: absolute;
    height: 80px;
       margin-top: -30px;
    margin-left: -78px;" src="/static/images/logo.png"></a>
	</div>
	<ul style="font-family: 'Source Sans Pro',sans-serif;">
		
			
<style type="text/css">
	

#pretrazeno_div::-webkit-scrollbar {
  width: 10px;
}

#pretrazeno_div::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
#pretrazeno_div::-webkit-scrollbar-thumb {
  background: #888; 
}

#pretrazeno_div::-webkit-scrollbar-thumb:hover {
  background: #555; 

	}
  .check_size{
    white-space: nowrap;
    line-height:19px;
  }
</style>



	<?php if (!isset($_SESSION['user']['id'])){ ?>

	  <li id="login"><a href="/login">PRIJAVI SE</a></li>
	  <li id="register"><a href="/register">REGISTRUJ SE</a></li>
	  <?php }else{ if ($_SESSION['user']['ime'] !== "" && $_SESSION['user']['prezime'] !== "") {
	  	$imeprezime = $_SESSION['user']['ime'] . " " . $_SESSION['user']['prezime'];
	  }else {
	  	$imeprezime = "Moj nalog";
	  } ?>
	
  		

	 
	  		<li class="userrs" style="overflow: hidden;
    width: 210px;"><a class="users" href="#" style="    height: 36px;"><span class="check_size" ><?php echo $imeprezime ?></span><span class="check_size" style="float: left;"><?php echo $_SESSION['user']['email']; ?></span></a>
  
<ul class="navbarli">
	<li id="creater" style="display: none;"><a  href="/user/create_post">POSTAVI OGLAS</a></li>
		<li><a id="moji"   href="/user/user?my=true">Moji oglasi</a></li>
		<li><a style="padding-top: 0px;"  href="/user/user?follow=true">Oglasi koje pratim</a></li>
		<li><a style="padding-top: 0px;"  href="/user/user?message=true">Poruke</a></li>
		<li><a style="padding-top: 0px;"  href="/user/user?pass=true">Promeni lozinku</a></li>

	<li><a style="padding-top: 0px;"  href="/user/user">Podesavanje</a></li>
  <?php
global $conn;
  $user_id = $_SESSION['user']['id'];
  $result = mysqli_query($conn, "SELECT * FROM company WHERE user_id=$user_id LIMIT 1");
  $company = mysqli_fetch_assoc($result);
  if ($company != '') {
   echo ' <li><a style="padding-top: 0px;
    padding: 13px 60px;
    background-color: #14264e;
    margin-bottom: 5px;"  href="/user/user_company">Prof. preduzeća</a></li>';
  }

   ?>
    <?php
global $conn;
  $user_id = $_SESSION['user']['id'];
  $result = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE role='Admin' AND id=$user_id LIMIT 1"));
 if ($result == 1) {
   echo ' <li><a style="padding-top: 0px;
    padding: 13px 86px;
    background-color: #14264e;
    margin-bottom: 5px;"  href="/admin/dashboard">Admin</a></li>';
  }

   ?>
 

	<li class="logout"></br><a style="padding-top: 0px;" href="/logout">Odjavi se</a></li>
</ul>
</li>
<?php }?>
	  <li id="create"><a id="checkedss" href="/user/create_post">POSTAVI OGLAS</a></li>
	</ul>

</div>
</div>