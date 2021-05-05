
<script type="text/javascript">
	   $(document).ready(function() {

	 $('#wtf').click(function() {
$('#logins').css({"display":"block"});
	 });
	 $('.messages').click(function() {
$('#logins').css({"display":"block"});
	 });
	  $('.btn').click(function() {
$('#logins').css({"display":"block"});
	 });
	  $('.btn_1').click(function() {
$('#logins').css({"display":"block"});
	 });
	 $('#exit').click(function(){
	 	$('#logins').css({"display":"none"});
	 });

	
	  
	  });
</script>

<?php  include('includes/registration_login.php'); ?>

<div id="logins" style=" display: none; background: #000000de;   width: 100%;
    height: 100%;top:50%!important;" class="logining">
<div >
		<form style="border-radius: 5px;
    background-color: #d1414b;
    margin-top: 314px;
" class="form1" method="post" >
<a id="exit" style="cursor: pointer;"><i class="far fa-times-circle"></i></a>

			<h2 style="color: white;">Prijavite se</h2>
			
			<input class="login-input" type="text" name="username" placeholder="Username"></br>
			<input class="login-input" type="password" name="password" placeholder="Password">
			<button type="submit" class="btn" name="login_btn">Prijavi se</button>
			<button style="    float: right;
    margin-top: -51px;" class="btn" href="/login"> Registruj se</button>
		</form>
	</div></div>