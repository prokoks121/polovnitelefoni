<?php 
	
	@ob_start();
	session_start();
	header('Content-Type: application/json');


	$conn = new PDO('mysql:host=localhost;dbname=polovnit_DeIzaci;charset=utf8','polovnit','4X]BO9j#N0n7ol');
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



    $stm = $conn->prepare("SELECT * FROM dogadjaji");
    $stm->execute();
     $result = $stm->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($result);
echo $json;

?>