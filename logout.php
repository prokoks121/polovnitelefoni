<?php 
	session_start();
	session_unset($_SESSION['user']);
	session_destroy();
	if(isset($_COOKIE["username"])) {
					setcookie ("username");
				}
				if(isset($_COOKIE["password"])) {
					setcookie ("password");
				}
	header('location: index');
?>