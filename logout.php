<?php
	session_start();
	session_unset();
	session_destroy();
	if(isset($_COOKIE["username"])) {
					setcookie ("username");
				}
				if(isset($_COOKIE["password"])) {
					setcookie ("password");
				}
	header('location: index');
?>
