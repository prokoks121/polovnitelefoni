<?php 
	@ob_start();
	session_start();
	

	$conn = mysqli_connect("localhost", "polovnit", "4X]BO9j#N0n7ol", "polovnit_DeIzaci");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



?>